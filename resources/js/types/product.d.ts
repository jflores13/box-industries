export interface Product {
  id: number;
  name: string;
  slug: string;
  short_description?: string | null;
  long_description?: string | null;
  button_text?: string | null;
  button_link?: string | null;
  image_src?: string | null;
  booklet_src?: string | null;
  product_id?: string | null;
  category?: string | null;
  tags?: string | null;
  on_carrousel?: boolean;
}