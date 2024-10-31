import useCategories from "../hooks/useCategories";

const CategoriesFilter = ({ categoryId, setCategoryId }) => {
  const { isPending, isError, error, data, isFetching, isPlaceholderData } =
    useCategories();

  const categories = data?.data;

  const handleCategoriesFilter = (e) => {
    setCategoryId(e.target.value);
  };

  return (
    <div className="flex flex-col gap-3 my-5">
      <h3 className="text-white font-bold">Filter by category:</h3>
      <select
        className="p-5 bg-lime-950 text-white"
        onChange={handleCategoriesFilter}
        name="category"
        id="category"
      >
        <option value="">All</option>
        {!isFetching && !error
          ? categories.map(({ id, name }) => (
              <option key={id} value={id}>
                {name}
              </option>
            ))
          : ""}
      </select>
    </div>
  );
};

export default CategoriesFilter;
