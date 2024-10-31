import { useState } from "react";
import useProducts from "../hooks/useProducts";
import Pagination from "./Pagination";
import ProductsTable from "./ProductsTable";
import CategoriesFilter from "./CategoriesFilter";

const Products = () => {
  const [page, setPage] = useState(0);
  const [categoryId, setCategoryId] = useState("");
  const [sortedBy, setSortedBy] = useState("");

  const { isPending, isError, error, data, isFetching, isPlaceholderData } =
    useProducts(categoryId, sortedBy, page);

  const products = data?.data;

  return (
    <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
      <CategoriesFilter categoryId={categoryId} setCategoryId={setCategoryId} />
      <ProductsTable
        products={products}
        isFetching={isFetching}
        isError={isError}
      />
      {data ? <Pagination metadata={data.meta} setPage={setPage} /> : ""}
    </div>
  );
};

export default Products;
