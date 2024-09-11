import { Contact } from "@/components/Contact";
import { Container } from "@/components/Container";
import { Heading } from "@/components/Heading";
import { Highlight } from "@/components/Highlight";
import { Paragraph } from "@/components/Paragraph";
import { Products } from "@/components/Products";
import { Metadata } from "next";
import Image from "next/image";

export const metadata: Metadata = {
  title: "contact | Dylan Nguyen",
  description:
  "Dylan Nguyen is an Electrical and Computer Engineering/Computer Science student at Duke University.",
};

export default function Projects() {
  return (
    <Container>
      <span className="text-4xl">✉️</span>
      <Heading className="font-black mb-2">get in touch</Heading>
      <Paragraph className="mb-10 max-w-xl">
        Reach out to me over email or fill up this contact form. I will get back
        to you ASAP - promise!{" "}
      </Paragraph>
      <Contact />
    </Container>
  );
}
