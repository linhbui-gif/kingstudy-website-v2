import React, { createContext, useState, useContext } from 'react';

const APIContext = createContext();

export const APIProvider = ({ children }) => {
  const [data, setData] = useState(null);

  const fetchData = async () => {
    const response = await fetch('https://api.example.com/data');
    const responseData = await response.json();
    setData(responseData);
  };

  return (
    <APIContext.Provider value={{ data, fetchData }}>
      {children}
    </APIContext.Provider>
  );
};

export const useAPI = () => useContext(APIContext);
