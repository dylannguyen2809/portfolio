
#import libraries
from flask import Flask, request, jsonify
import requests
import re
from datetime import date, timedelta

#return the url of the chatbot
def store_url(key):
  return f'https://store.ncss.cloud/{key}'

#sends a POST request (i.e. the books dictionary) to the database via storage API
def store_set(key, data):
  url = store_url(key)
  data = requests.post(url, json=data)
  if data.status_code == 404:
    return 'There was an error'

#get the books dicitonary from storage api
def store_get(key):
  url = store_url('syd-3')
  response = requests.get(url)

  # If the user has data
  # unpack the information and print it out
  if response.status_code == 200:
    data = response.json()
    #print(response.status_code)
    return data
  else:
    print(response.status_code)
  return False

#make an app using Flask
app = Flask(__name__)

def retrieve_book_list():
  books = store_get('syd-3')
  if not books:
      books = {
        'booklist': []
      }

  # Sets up headings for all of the tables
  text = f'''
  <table style = "width:100%; border: 1px solid black">
  <tr>
  <th style = "text-align: left">Book Title</th>
  <th style = "text-align: left">Date Borrowed</th>
  <th style = "text-align: left">Return Date</th>
  </tr>'''

  #Loops through all of the books
  for book in books['booklist']:
    borrowed_date = book['borrowed']
    return_date = book['return_date']
    text += f'''
    <tr>

    <td>{book['title']}</td>

    <td>{borrowed_date}</td>

    <td>{return_date}
    </tr>'''

  text += '</table>' #Finishes off by adding end table, allows for multiple books to be displayed.

  message = {
    'author': 'Borrow Bot',
    'text': text
  }

  # Return the JSON
  return jsonify(message)

def date_string(pre_date):

  #Checks which value the day is to add 
  value_check = pre_date.strftime('%d').lstrip("0").replace(" 0", " ")

  display_date = pre_date.strftime('%A, %B %d').lstrip("0").replace(" 0", " ")

  if value_check == '1':
    display_date += 'st'

  elif value_check == '2':
    display_date += 'nd'

  elif value_check == '3':
    display_date += 'rd'

  else:
    display_date += 'th'


  return display_date

#return book from borrow list
@app.route('/return', methods=['GET', 'POST'])
def return_book():
   # Read the message from NeCSuS
  data = request.get_json()
  if data != False:
    reg = re.match(r'.*return (?P<title>.+).*', data['text'])
    if reg is not None:
      text = reg.group('title')
    reg2 = re.match(r'when.*return\s(?P<title>.+)', data['text'])
    if reg2 is not None:
      #gets the book list from storage
      books = store_get("syd-3")

      for book in books['booklist']:
        if book['title'] == text:
          message = {
            'author': 'borrow bot',
            'text': f"You need to return {book['title']} by the {book['return_date']}."
          }
          return jsonify(message)

      message = {
          'author': 'borrow bot',
          'text': f'That book is not in your borrowed list.'
        }
      return jsonify(message)

    #gets the book list from storage
    books = store_get("syd-3")

    if not books:
      books = {
        'booklist': []
      }

    for book in books['booklist']:
      if book['title'] == text:
        books['booklist'].remove(book)
        store_set('syd-3', books)
        # Create a message to send to the server
        message = {
          'author': 'borrow bot',
          'text': f'Returned {text}!'
        }
        return jsonify(message)
     # Create a message to send to the server
    message = {
      'author': 'borrow bot',
      'text': f'{text} is not in your borrowed list!'
    }
    return jsonify(message)
  return {}

#enter item into database
@app.route('/borrow', methods=['POST', 'GET'])
def borrow():
  # Read the message from NeCSuS
  data = request.get_json()
  if data != False:
    reg = re.match(r'.*borrow (?P<title>.+).*', data['text'])
    if reg is not None:
      text = reg.group('title')
    else:
      text = "I don't know that book."
    # Create a message to send to the server
    message = {
      'author': 'borrow bot',
      'text': f'Borrowed {text}!'
    }
    
    #no touchy
    date_current = date.today()
    borrow_date = date_string(date_current)
    return_date = date_string(date_current + timedelta(days=14))

    #updates the book list and send to storage
    books = store_get("syd-3")

    new_book = {
      "title": f"{text}",
      "borrowed": f"{borrow_date}",
      "return_date": f"{return_date}",
    }

    if not books:
      books = {
        'booklist': []
      }

    books['booklist'].append(new_book)
    store_set('syd-3', books)
    #print(books)
      
    #return bot message to user
    return jsonify(message)
  return {}

#etrieve list of all items from dictionary
@app.route('/bigboybot', methods=['POST', 'GET'])
def List_Bot():
  data = request.get_json()
  if data != False:
    reg = re.match(r'.*list (?P<title>.+).*', data['text'])
    if reg is not None:
      text = reg.group('title')

    # Create a message to send to the server
    message = {
      'author': 'Borrow Bot',
      'text': f'Return List'
    }
    
    message = retrieve_book_list()

    #return bot message to user
    return message
  return {}

#run the server
app.run(debug=True, host='0.0.0.0')

  
