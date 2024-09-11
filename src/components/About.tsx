"use client";
import { Paragraph } from "@/components/Paragraph";
import Image from "next/image";
import Link from "next/link";
import aboutMe1 from "public/images/aboutme1.png";
import aboutMe2 from "public/images/aboutme2.png";
import aboutMe3 from "public/images/aboutme3.png";
import aboutMe4 from "public/images/aboutme4.png";
import aboutMe5 from "public/images/aboutme5.png";

import { motion } from "framer-motion";

export default function About() {
  const images = [ aboutMe1, aboutMe5, aboutMe3, aboutMe4 ];
  return (
    <div>
      <div className="grid grid-cols-2 md:grid-cols-4 gap-10 my-10">
        {images.map((image, index) => (
          <motion.div
            key={image}
            initial={{
              opacity: 0,
              y: -50,
              rotate: 0,
            }}
            animate={{
              opacity: 1,
              y: 0,
              rotate: index % 2 === 0 ? 3 : -3,
            }}
            transition={{ duration: 0.2, delay: index * 0.1 }}
          >
            <Image
              src={image}
              width={200}
              height={400}
              alt="about"
              className="rounded-md object-cover transform rotate-3 shadow-xl block w-full h-40 md:h-60 hover:rotate-0 transition duration-200"
            />
          </motion.div>
        ))}
      </div>

      <div className="max-w-4xl">
        <Paragraph className=" mt-4">
          G&apos;day, I&apos;m Dylan! I&apos;m a junior studying ECE/CS at Duke University,
          which actually means that I just camp out in the makerspaces fixing code, shorting wires, 
          and commiserating with other engineers. I grew up in Sydney, Australia, but decided to trade in the beaches and 
          sunshine for the chance to learn amazing things alongside even more amazing people at Duke.
        </Paragraph>
        <Paragraph className=" mt-4">
          I am the project lead for Qubit at Duke&apos;s <a className="font-medium text-blue-500 dark:text-blue-400 overflow-wrap: break-word hover:text-blue-600" href='https://sites.duke.edu/createcenter'>Center for Research and Engineering of AI Technology in Education</a>, where we make transformative AI tools for education.
          Qubit&apos;s mission is to bring a world-class AI tutor to every 
          student&apos;s code editor. So far, Qubit is already helping hundreds of students from the high school through to graduate levels, 
          and our early results are really exciting!
        </Paragraph>

        <Paragraph className=" mt-4">
          Before coming to Duke, I built fire risk models for an Australian Government-funded bushfire resilience 
          app at the Resilient Building Council. To date, it&apos;s enabled 19,000 homeowners to make their houses two-thirds 
          less likely to catch on fire, and has been responsible for $44,000,000 of investment in fire safety across the country.
          I got the gig after one of my projects was <Link className="font-medium text-blue-500 dark:text-blue-400  overflow-wrap: break-word hover:text-blue-600" href='https://www.facebook.com/watch/?v=347355687124444'>featured on Australian TV.</Link>
        </Paragraph>
        <Paragraph className=" mt-4">
          Now, the serious stuff: I coach an under-6 basketball team (go Dinos!) that finished the season with a 
          glorious 3-5 record. I also love doing martial arts—I took up judo 12 years ago after watching Kung Fu Panda, 
          and ended up becoming an two-division Australian junior champion by mastering the Wuxi Finger Hold.
        </Paragraph>
        <Paragraph className=" mt-4">
          I hope you enjoy your time here! If you&apos;d like to chat or grab a coffee, 
          you can find me at <a className="font-medium text-blue-500 dark:text-blue-400 overflow-wrap: break-word hover:text-blue-600" href='https://dylannguyen289@gmail.com'>dylannguyen289[at]gmail[dot]com.</a> Don&apos;t be a stranger!
        </Paragraph>
      </div>
    </div>
  );
}
