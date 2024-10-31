import { useState } from "react";
import useCreateProduct from "../hooks/useCreateProduct";

const CreateProduct = () => {
  const [toggleForm, setToggleForm] = useState(false);
  const [formData, setFormData] = useState({
    name: "",
    description: "",
    price: "",
    category: "",
    image: null,
  });

  const createProduct = useCreateProduct();

  const handleChange = (e) => {
    const { name, value, files } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: files ? files[0] : value,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    const data = new FormData();
    data.append("name", formData.name);
    data.append("description", formData.description);
    data.append("price", formData.price);
    data.append("category", formData.category);
    if (formData.image) {
      data.append("image", formData.image);
    }
    createProduct.mutate(data);
  };

  return (
    <div>
      <button
        className="bg-blue-800 text-white p-5 rounded-md"
        onClick={() => setToggleForm((prev) => !prev)}
      >
        Create Product
      </button>
      {toggleForm ? (
        <form
          onSubmit={handleSubmit}
          className="bg-white p-10 rounded-sm text-sm font-medium text-gray-900"
        >
          <div className="mb-5">
            <label htmlFor="name" className="block mb-2 ">
              Name :
            </label>
            <input
              type="name"
              id="name"
              name="name"
              className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required
              onChange={handleChange}
            />
          </div>
          <div className="mb-5">
            <label htmlFor="description" className="block mb-2 ">
              Description :
            </label>
            <textarea
              id="description"
              className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required
              name="description"
              onChange={handleChange}
            ></textarea>
          </div>
          <div className="mb-5">
            <label htmlFor="price" className="block mb-2 ">
              Price :
            </label>
            <input
              type="number"
              step={0.1}
              id="price"
              name="price"
              className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required
              onChange={handleChange}
            />
          </div>
          <div className="mb-5">
            <label htmlFor="image" className="block mb-2 ">
              Image :
            </label>
            <input
              type="file"
              id="image"
              name="image"
              className="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
              required
              onChange={handleChange}
            />
          </div>
          <button
            type="submit"
            className="bg-green-500 py-2 px-4 rounded-md text-white font-bold"
          >
            Submit
          </button>
        </form>
      ) : (
        ""
      )}
    </div>
  );
};

export default CreateProduct;
