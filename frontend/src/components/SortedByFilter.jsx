const SortedByFilter = ({ setSortedBy }) => {
  const handleSortedByFilter = (e) => {
    setSortedBy(e.target.value);
  };

  return (
    <div className="flex flex-col gap-3 my-5">
      <h3 className="text-white font-bold">Sorted by :</h3>
      <select
        className="p-5 bg-lime-950 text-white"
        onChange={handleSortedByFilter}
        name="sortBy"
        id="sortBy"
      >
        <option value="name">Name</option>
        <option value="price">price</option>
      </select>
    </div>
  );
};

export default SortedByFilter;
