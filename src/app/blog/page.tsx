import { Container } from "@/components/Container";
import { Heading } from "@/components/Heading";
import { Highlight } from "@/components/Highlight";
import { Paragraph } from "@/components/Paragraph";
import { Products } from "@/components/Products";
import { getAllBlogs } from "../../../lib/getAllBlogs";
import { Blogs } from "@/components/Blogs";
import { Metadata } from "next";

export const metadata: Metadata = {
  title: "essays | Dylan Nguyen",
  description:
    "Dylan Nguyen is an Electrical and Computer Engineering/Computer Science student at Duke University.",
};

export default async function Blog() {
  const blogs = await getAllBlogs();
  const data = blogs.map(({ component, ...meta }) => meta);

  return (
    <Container>
      <span className="text-4xl">📝</span>
      <Heading className="font-black pb-4">essays</Heading>
      <Paragraph className="pb-10">
        I write from time to time. The good words end up here.
      </Paragraph>
      <Blogs blogs={data} />
    </Container>
  );
}
