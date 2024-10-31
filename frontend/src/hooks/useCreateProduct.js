import { useMutation } from "@tanstack/react-query";

const useCreateProduct = () => {
  const mutation = useMutation({
    mutationFn: async (newProduct) => {
      const response = await fetch(
        `${import.meta.env.VITE_BASE_URL}/products`,
        {
          method: "POST",
          body: newProduct,
        }
      );

      if (!response.ok) {
        throw new Error("Network response was not ok");
      }
      return response.json();
    },
    onSuccess: (data) => {
      console.log("Product created successfully", data);
    },
    onError: (error) => {
      console.error("Error creating product:", error.message);
    },
  });

  return mutation;
};

export default useCreateProduct;
