import { fetchProducts } from "./requests";
import { useQuery, keepPreviousData } from "@tanstack/react-query";

const useProducts = (categoryId = '', sort_by = '', page = '') => {
  const { isPending, isError, error, data, isFetching, isPlaceholderData } =
    useQuery({
      queryKey: ["products", categoryId, sort_by, page],
      queryFn: () => fetchProducts(categoryId, sort_by, page),
      placeholderData: keepPreviousData,
    });

  return { isPending, isError, error, data, isFetching, isPlaceholderData };
};

export default useProducts;
