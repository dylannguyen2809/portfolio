import { Container } from "@/components/Container";
import { Heading } from "@/components/Heading";
import { Highlight } from "@/components/Highlight";
import { Paragraph } from "@/components/Paragraph";
import { Products } from "@/components/Products";
import { WorkHistory } from "@/components/WorkHistory";
import Image from "next/image";

export default function Home() {
  return (
    <Container>
      <span className="text-4xl">💼</span>
      <Heading className="font-black">resume</Heading>
      <Paragraph className="max-w-xl mt-4">
        I&apos;m an ECE/CS student with track record of applying AI, data science and software engineering to create impact across domains. 
        Seeking roles that offer <Highlight>ambitious problems</Highlight> and <Highlight>high expectations.</Highlight>
      </Paragraph>
      <WorkHistory />
    </Container>
  );
}
