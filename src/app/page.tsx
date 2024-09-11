import { Container } from "@/components/Container";
import { Heading } from "@/components/Heading";
import { Highlight } from "@/components/Highlight";
import { Paragraph } from "@/components/Paragraph";
import { Products } from "@/components/Products";
import { TechStack } from "@/components/TechStack";
import Image from "next/image";

export default function Home() {
  return (
    <Container>
      <span className="text-4xl">👋</span>
      <Heading className="font-black">hi! i&apos;m dylan.</Heading>
      <Paragraph className="max-w-xl mt-4">
        I&apos;m a junior studying ECE/CS at {" "}
        <Highlight>Duke University</Highlight>, which actually means I camp out in the makerspaces fixing code, shorting wires, 
        and commiserating with other engineers.
      </Paragraph>
      <Paragraph className="max-w-xl mt-4">
        I lead the Qubit project at Duke&apos;s <Highlight>Center for AI Technology in Education</Highlight>, and 
        also spent a few years developing technology to help Australians protect themselves from wildfires.
      </Paragraph>
      <Heading
        as="h2"
        className="font-black text-lg md:text-lg lg:text-lg mt-20 mb-4"
      >
        what I&apos;ve been working on
      </Heading>
      <Products />
      <TechStack />
    </Container>
  );
}
