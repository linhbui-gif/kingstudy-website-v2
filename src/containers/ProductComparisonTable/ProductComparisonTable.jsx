import React, { useRef } from 'react';

import html2canvas from 'html2canvas';
import { jsPDF } from 'jspdf';

const ProductComparisonTable = () => {
  const tableRef = useRef();

  const products = [
    {
      name: 'Product 1',
      price: '$100',
      image: 'https://devwebsite.kingstudy.vn/static/2024/06/19/705087616a18f6c84c162ae9f37052552fdfda40.jpeg',
      feature1: 'Feature 1.1',
      feature2: 'Feature 1.2',
      feature3: 'Feature 1.3',
    },
    {
      name: 'Product 2',
      price: '$150',
      image: 'https://devwebsite.kingstudy.vn/static/2024/06/19/705087616a18f6c84c162ae9f37052552fdfda40.jpeg',
      feature1: 'Feature 2.1',
      feature2: 'Feature 2.2',
      feature3: 'Feature 2.3',
    },
    {
      name: 'Product 3',
      price: '$200',
      image: 'https://devwebsite.kingstudy.vn/static/2024/06/19/705087616a18f6c84c162ae9f37052552fdfda40.jpeg',
      feature1: 'Feature 3.1',
      feature2: 'Feature 3.2',
      feature3: 'Feature 3.3',
    },
  ];

  const downloadPDF = async () => {
    const input = tableRef.current;
    const canvas = await html2canvas(input, { scale: 3, useCORS: true });
    const imgData = canvas.toDataURL('image/png');
    const pdf = new jsPDF('landscape');
    const pdfWidth = pdf.internal.pageSize.getWidth();
    const pdfHeight = (canvas.height * pdfWidth) / canvas.width;
    pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
    pdf.save('product-comparison.pdf');
  };

  return (
    <div className="min-h-screen bg-gray-100 flex items-center justify-center p-6">
      <div className="w-full max-w-5xl">
        <h1 className="text-4xl font-bold mb-8 text-center text-gray-800">
          Product Comparison Table
        </h1>
        <div
          className="overflow-x-auto shadow-lg rounded-lg bg-white p-4"
          ref={tableRef}
        >
          <table className="min-w-full bg-white border border-gray-200">
            <thead>
              <tr>
                <th className="py-3 px-5 bg-blue-500 text-white text-left text-sm uppercase font-bold tracking-wider">
                  Feature
                </th>
                {products.map((product, index) => (
                  <th
                    key={index}
                    className="py-3 px-5 bg-blue-500 text-white text-left text-sm uppercase font-bold tracking-wider"
                  >
                    {product.name}
                  </th>
                ))}
              </tr>
            </thead>
            <tbody>
              <tr>
                <td className="py-4 px-5 border-b border-gray-200 font-[700]">Image</td>
                {products.map((product, index) => (
                  <td
                    key={index}
                    className="py-4 px-5 border-b border-gray-200 font-[700]"
                  >
                    <img
                      src={product.image}
                      alt={product.name}
                      className="w-24 h-24 object-cover rounded"
                    />
                  </td>
                ))}
              </tr>
              <tr className="bg-gray-100">
                <td className="py-4 px-5 border-b border-gray-200 font-[700]">Price</td>
                {products.map((product, index) => (
                  <td
                    key={index}
                    className="py-4 px-5 border-b border-gray-200 font-[700]"
                  >
                    {product.price}
                  </td>
                ))}
              </tr>
              <tr>
                <td className="py-4 px-5 border-b border-gray-200 font-[700]">
                  Feature 1
                </td>
                {products.map((product, index) => (
                  <td
                    key={index}
                    className="py-4 px-5 border-b border-gray-200 font-[700]"
                  >
                    {product.feature1}
                  </td>
                ))}
              </tr>
              <tr className="bg-gray-100">
                <td className="py-4 px-5 border-b border-gray-200 font-[700]">
                  Feature 2
                </td>
                {products.map((product, index) => (
                  <td
                    key={index}
                    className="py-4 px-5 border-b border-gray-200 font-[700]"
                  >
                    {product.feature2}
                  </td>
                ))}
              </tr>
              <tr>
                <td className="py-4 px-5 border-b border-gray-200 font-[700]">
                  Feature 3
                </td>
                {products.map((product, index) => (
                  <td
                    key={index}
                    className="py-4 px-5 border-b border-gray-200 font-[700]"
                  >
                    {product.feature3}
                  </td>
                ))}
              </tr>
            </tbody>
          </table>
        </div>
        <button
          onClick={downloadPDF}
          className="mt-6 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
        >
          Download PDF
        </button>
      </div>
    </div>
  );
};

export default ProductComparisonTable;
