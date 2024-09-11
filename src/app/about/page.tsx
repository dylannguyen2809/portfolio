import { Container } from "@/components/Container";
import { Heading } from "@/components/Heading";
import { Highlight } from "@/components/Highlight";
import { Paragraph } from "@/components/Paragraph";
import { Products } from "@/components/Products";
import { Metadata } from "next";
import Image from "next/image";
import aboutMe1 from "public/images/aboutme1.png";
import aboutMe2 from "public/images/aboutme2.png";
import aboutMe3 from "public/images/aboutme3.png";
import aboutMe4 from "public/images/aboutme4.png";
import aboutMe5 from "public/images/aboutme5.png";

import { motion } from "framer-motion";
import About from "@/components/About";

export const metadata: Metadata = {
  title: "about | Dylan Nguyen",
  description:
    "Dylan Nguyen is an Electrical and Computer Engineering/Computer Science student at Duke University.",
};

export default function AboutPage() {
  const images = [
    aboutMe1,
    aboutMe5,
    aboutMe3,
    aboutMe4 
  ];
  return (
    <Container>
      <span className="text-4xl">💬</span>
      <Heading className="font-black">about me</Heading>
      <About />
    </Container>
  );
}
