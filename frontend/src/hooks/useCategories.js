import { fetchCategories } from "./requests";
import { useQuery, keepPreviousData } from "@tanstack/react-query";

const useCategories = () => {
  const { isPending, isError, error, data, isFetching, isPlaceholderData } =
    useQuery({
      queryKey: ["categories"],
      queryFn: () => fetchCategories(),
      placeholderData: keepPreviousData,
    });

  return { isPending, isError, error, data, isFetching, isPlaceholderData };
};

export default useCategories;
