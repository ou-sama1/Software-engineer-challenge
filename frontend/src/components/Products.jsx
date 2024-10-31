import { useState } from "react";
import useProducts from "../hooks/useProducts";
import Pagination from "./Pagination";
import ProductsTable from "./ProductsTable";
import CategoriesFilter from "./CategoriesFilter";
import CreateProduct from "./CreateProduct";
import SortedByFilter from "./SortedByFilter";

const Products = () => {
  const [page, setPage] = useState(0);
  const [categoryId, setCategoryId] = useState("");
  const [sortedBy, setSortedBy] = useState("");

  const { isPending, isError, error, data, isFetching, isPlaceholderData } =
    useProducts(categoryId, sortedBy, page);

  const products = data?.data;

  return (
    <div className="relative overflow-x-auto shadow-md sm:rounded-lg">
      <CreateProduct />
      <div className="flex gap-10 justify-between items-center">
        <CategoriesFilter
          categoryId={categoryId}
          setCategoryId={setCategoryId}
        />
        <SortedByFilter setSortedBy={setSortedBy} />
      </div>
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
