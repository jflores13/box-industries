export interface Product {
  id: number;
  name: string;
  slug: string;
  short_en?: string | null;
  short_es?: string | null;
  long_en?: string | null;
  long_es?: string | null;
  button_en?: string | null;
  button_es?: string | null;
  home_en?: string | null;
  home_es?: string | null;
  // Legacy (kept optional for backward compatibility in public views)
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