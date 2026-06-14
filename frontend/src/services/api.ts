export async function fetchPosts(perPage = 10, page = 1) {
  const url = `${process.env.NEXT_PUBLIC_WP_API_URL}/posts?_embed&per_page=${perPage}&page=${page}`;
  try {
    const res = await fetch(url, { next: { revalidate: 60 } });
    if (!res.ok) {
      console.error('Failed to fetch posts:', res.status, res.statusText);
      return [];
    }
    return res.json();
  } catch (error) {
    console.error('Error fetching posts:', error);
    return [];
  }
}

export async function fetchPostBySlug(slug: string) {
  const url = `${process.env.NEXT_PUBLIC_WP_API_URL}/posts?_embed&slug=${slug}`;
  try {
    const res = await fetch(url, { next: { revalidate: 60 } });
    if (!res.ok) {
      console.error('Failed to fetch post by slug:', res.status, res.statusText);
      return null;
    }
    const posts = await res.json();
    return posts.length > 0 ? posts[0] : null;
  } catch (error) {
    console.error('Error fetching post by slug:', error);
    return null;
  }
}

export async function fetchCategories() {
  const url = `${process.env.NEXT_PUBLIC_WP_API_URL}/categories`;
  try {
    const res = await fetch(url, { next: { revalidate: 3600 } });
    if (!res.ok) {
      console.error('Failed to fetch categories:', res.status, res.statusText);
      return [];
    }
    return res.json();
  } catch (error) {
    console.error('Error fetching categories:', error);
    return [];
  }
}
