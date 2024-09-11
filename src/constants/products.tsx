import sidefolioAceternity from "public/images/sidefolio-aceternity-2.png";
import sidefolioAceternity2 from "public/images/sidefolio-aceternity-2.png";
import sidefolioAlgochurn from "public/images/sidefolio-algochurn.png";
import sidefolioAlgochurn2 from "public/images/sidefolio-algochurn.png";
import Link from "next/link";
import sidefolioMoonbeam from "public/images/sidefolio-moonbeam.png";
import sidefolioMoonbeam2 from "public/images/sidefolio-moonbeam-2.png";
import sidefolioTailwindMasterKit from "public/images/sidefolio-tailwindmasterkit.png";
import sidefolioTailwindMasterKit2 from "public/images/sidefolio-tailwindmasterkit-2.png";
import qubit from "public/images/qubit.png";
import qubit2 from "public/images/qubit2.png";
import brsr from "public/images/brsr.png";
import brsr2 from "public/images/brsr2.png";
import satalight from "public/images/satalight.png";


export const products = [
  {
    href: "https://marketplace.visualstudio.com/items?itemName=DukeCREATE.qubit&ssr=false#overview",
    title: "Qubit",
    description:
      "A world-class teaching assistant in your code editor.",
    thumbnail: qubit,
    images: [qubit, qubit2],
    stack: ["Next.js", "React", "Python", "Prisma", "MySQL", "MongoDB", "Azure"],
    slug: "qubit",
    content: (
      <div>
        <p>
        Qubit is a teaching assistant integrated within your code editor, designed to make learning programming more accessible and less intimidating.
        Programming is difficult—code very rarely works on the first try, and the fact that you have to be willing to fail 
        repeatedly to learn can be overwhelming for many students. It’s no coincidence that, at the higher education level, 
        computer science has the highest dropout rate among all majors. Qubit&apos;s goal is to reduce the friction of 
        learning to code in a personal, scalable way.{" "}
        </p>
        <p>
        <b>Conversational Help</b><br/>
        Qubit is available 24/7 to answer any programming-related questions.
        It provides guidance without directly giving away solutions, encouraging students to learn and understand the concepts.
       
        </p>{" "}
        <p>
          <b>Direct Code Access</b><br/>
          Qubit can interact directly with your code.
          This feature allows Qubit to offer you specific and relevant debugging assistance, making the troubleshooting process more efficient.
        </p>{" "}
        <p>
          <b>Visible & Personal Learning</b><br/>
            You can visually track your progress as they learn to code.
            Qubit offers customization options for interactions, catering to individual learning preferences.
        </p>
      </div>
    ),
  },
  {
    href: "https://rbcouncil.org/resilience-ratings/",
    title: "Bushfire Resilience Ratings App",
    description:
      "Intelligent home improvement recommendations protecting 19,000 Australian homes from fires.",
    thumbnail: brsr2,
    images: [brsr2, brsr],
    stack: ["Python", "Google Earth Engine", "React", "JavaScript"],
    slug: "brsr",
    content: (
      <div>
        <p>
          As a technical consultant at the Resilient Building Council, I created an environmental 
          fire risk model used by 19,000+ homes, leading to $44,000,000+ of investment in 
          resilient home improvements.{" "}
        </p>
        <p>
          The foundation for this was my work processing regional datasets, extending on my SatAlight work to generate the highest 
          resolution national-scale bushfire risk map available in Australia, beating the on previous best by 830%.
        </p>
        <p>
          I also wrote novel software for house shape modeling as part of the larger risk model, resulting in a 94% 
          increase in accuracy of house shape predictions and improving the performance of the
          overall house loss probability model.
        </p>{" "}
      </div>
    ),
  },
  {
    href: "satalight.herokuapp.com",
    title: "SatAlight",
    description:
      "Award-winning computer vision wildfire risk model.",
    thumbnail: satalight,
    images: [satalight],
    stack: ["Python", "Keras", "Deep Learning", "Computer Vision", "Google Earth Engine]"],
    slug: "moonbeam",
    content: (
      <div>
        <p>
        SatAlight is an artificial intelligence system built to rapidly assess the 
        bush fire proneness of land areas throughout New South Wales. It uses 
        satellite imagery to accurately classify vegetation areas based on their bush 
        fire risk. Its intended use is to inform area managers and residents about the 
        bush fire hazard of their local areas, thus helping these key stakeholders to 
        be prepared for potential bush fire activity. SatAlight was presented to the 
        NSW Rural Fire Service, who are now looking to implement it in their land mapping processes.
        {" "}
        </p>
        <p>
        From testing of the algorithm against 2000 unseen images, it was found that the algorithm 
        had an accuracy of over 83%. The project was <Link href="https://www.facebook.com/watch/?v=347355687124444"> featured on ABC National News</Link> in September 2021,
        and won Australia&apos;s Young ICT Explorers Award in 2021. You can read about it <Link href="https://www.computerworld.com/article/1618447/oztech-aussie-cio-and-ciso-priorities-for-2022-new-effort-on-digital-skills-telstra-news-from-mwc-y.html">here</Link>, 
        {" "}<Link href="https://ia.acs.org.au/article/2022/australia-s-youngest-tech-innovators-recognised.html">here</Link>
        {" "} and <Link href="https://itwire.com/business-it-sp-511/business-it/student-inventors-bag-prizes-at-this-year%e2%80%99s-sap-se-young-ict-explorers-competition.html">here.</Link>
        </p>{" "}
      </div>
    ),
  },
];
