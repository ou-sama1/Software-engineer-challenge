import axios from "axios";

const baseUrl = import.meta.env.VITE_BASE_URL;

async function fetchProducts(categoryId, sort_by, page) {
  const response = await axios.get(
    `${baseUrl}/products?category_id=${categoryId}&sort_by=${sort_by}&page=${page}`
  );
  return response.data;
}

async function fetchCategories() {
  const response = await axios.get(`${baseUrl}/categories`);
  return response.data;
}

export { fetchProducts, fetchCategories };
