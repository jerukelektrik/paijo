import { fetchPostBySlug } from "@/services/api";
import { notFound } from "next/navigation";
import { Button } from "@/components/ui/button";
import Link from "next/link";

export const revalidate = 60; // ISR

export default async function PostDetail({ params }: { params: { slug: string } }) {
  const post = await fetchPostBySlug(params.slug);

  if (!post) {
    notFound();
  }

  const featuredImage = post._embedded?.["wp:featuredmedia"]?.[0]?.source_url;

  return (
    <main className="container mx-auto py-8 px-4 max-w-4xl">
      <div className="mb-6">
        <Button asChild variant="ghost">
          <Link href="/">&larr; Kembali ke Beranda</Link>
        </Button>
      </div>
      
      <article className="prose lg:prose-xl dark:prose-invert max-w-none">
        <header className="mb-8">
          <h1 dangerouslySetInnerHTML={{ __html: post.title.rendered }} className="text-4xl font-bold mb-4" />
          <div className="text-gray-500 text-sm">
            Dipublikasikan pada: {new Date(post.date).toLocaleDateString("id-ID", { year: 'numeric', month: 'long', day: 'numeric' })}
          </div>
        </header>

        {featuredImage && (
          <div className="mb-8 rounded-lg overflow-hidden">
            {/* eslint-disable-next-line @next/next/no-img-element */}
            <img src={featuredImage} alt={post.title.rendered} className="w-full h-auto" />
          </div>
        )}

        <div dangerouslySetInnerHTML={{ __html: post.content.rendered }} className="mt-8" />
      </article>
    </main>
  );
}
