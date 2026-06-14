import Link from "next/link";
import { fetchPosts } from "@/services/api";
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from "@/components/ui/card";
import { Button } from "@/components/ui/button";

export const revalidate = 60; // ISR revalidation every 60s

export default async function Home() {
  const posts = await fetchPosts(10, 1);

  return (
    <main className="container mx-auto py-8 px-4">
      <header className="mb-12 text-center">
        <h1 className="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl dark:text-gray-100">
          Pandangan Jogja
        </h1>
        <p className="mt-6 text-lg leading-8 text-gray-600 dark:text-gray-300">
          Portal Berita Modern Terkini
        </p>
      </header>

      <section>
        <h2 className="text-2xl font-semibold mb-6">Berita Terbaru</h2>
        {posts && posts.length > 0 ? (
          <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {posts.map((post: any) => (
              <Card key={post.id} className="flex flex-col">
                {post._embedded?.["wp:featuredmedia"]?.[0]?.source_url && (
                  <div className="w-full h-48 overflow-hidden rounded-t-lg">
                    {/* eslint-disable-next-line @next/next/no-img-element */}
                    <img
                      src={post._embedded["wp:featuredmedia"][0].source_url}
                      alt={post.title.rendered}
                      className="w-full h-full object-cover transition-transform hover:scale-105"
                    />
                  </div>
                )}
                <CardHeader>
                  <CardTitle className="text-xl">
                    <Link href={`/${post.slug}`} className="hover:text-blue-600 transition-colors" dangerouslySetInnerHTML={{ __html: post.title.rendered }} />
                  </CardTitle>
                </CardHeader>
                <CardContent className="flex-grow">
                  <div className="text-gray-600 dark:text-gray-400 text-sm line-clamp-3" dangerouslySetInnerHTML={{ __html: post.excerpt.rendered }} />
                </CardContent>
                <CardFooter>
                  <Button asChild variant="outline" className="w-full">
                    <Link href={`/${post.slug}`}>Baca Selengkapnya</Link>
                  </Button>
                </CardFooter>
              </Card>
            ))}
          </div>
        ) : (
          <div className="text-center text-gray-500 py-12">
            Belum ada berita. (Pastikan WP API berjalan dan ada post yang dipublish).
          </div>
        )}
      </section>
    </main>
  );
}
