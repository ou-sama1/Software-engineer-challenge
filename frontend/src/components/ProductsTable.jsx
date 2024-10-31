const ProductsTable = ({ products, isFetching, isError }) => {
  return (
    <table className="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
      <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
        <tr>
          <th scope="col" className="px-6 py-3">
            ID
          </th>
          <th scope="col" className="px-6 py-3">
            Image
          </th>
          <th scope="col" className="px-6 py-3">
            Name
          </th>
          <th scope="col" className="px-6 py-3">
            Description
          </th>
          <th scope="col" className="px-6 py-3">
            Price
          </th>
          <th scope="col" className="px-6 py-3">
            Categories
          </th>
        </tr>
      </thead>
      <tbody>
        {isFetching ? (
          <tr>
            <td colSpan={6} className="text-center py-4 text-gray-500">
              Loading products...
            </td>
          </tr>
        ) : isError ? (
          <tr>
            <td colSpan={6} className="text-center py-4 text-gray-500">
              An error occured.
            </td>
          </tr>
        ) : (
          products.map(
            ({ id, name, description, price, categories, image }) => (
              <tr
                key={id}
                className="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700"
              >
                <td className="px-6 py-4">{id}</td>
                <td className="px-6 py-4">
                  <img
                    src={`${import.meta.env.VITE_PUBLIC_URL}/${image}`}
                    alt={name}
                  />
                </td>
                <td className="px-6 py-4">{name}</td>
                <td className="px-6 py-4">{description}</td>
                <td className="px-6 py-4">{price}</td>
                <td className="px-6 py-4 flex gap-3 max-w-30 flex-wrap">
                  {categories?.map(({ id, name }) => (
                    <span key={id}>{name}</span>
                  ))}
                </td>
              </tr>
            )
          )
        )}
      </tbody>
    </table>
  );
};

export default ProductsTable;
