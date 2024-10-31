const Pagination = ({ metadata, setPage }) => {
  const { links, current_page } = metadata;
  const goToPage = (link, i) => {
    let newPage = 0;
    if (i === 0) {
      newPage = current_page - 1;
    } else if (i === links.length - 1) {
      newPage = current_page + 1;
    } else newPage = link.label;

    setPage(newPage);
  };

  return (
    <ul className="flex flex-row gap-2 items-center justify-center my-4">
      {links.map((link, i) => (
        <button
          key={link.label}
          onClick={() => goToPage(link, i)}
          className={`border p-4 hover:bg-slate-700 bg-slate-400 hover:text-white ${
            link.active ? "bg-slate-800 text-white" : !link.url ? "hidden" : ""
          }`}
        >
          {i === 0 ? "<<" : i === links.length - 1 ? ">>" : link.label}
        </button>
      ))}
    </ul>
  );
};

export default Pagination;
