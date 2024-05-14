import React, { createContext, useState, useContext, useEffect } from 'react';

import { getCountries } from '@/services/common';
import { getListSchool } from '@/services/school';
import { changeArrayToOptions } from '@/utils/utils';

const APIContext = createContext();

export const APIProvider = ({ children }) => {
  const [schoolList, setSchools] = useState([]);
  const [loading, setLoading] = useState(false);
  const [countries, setCountries] = useState([]);
  const [filterSchool, setFilterSchool] = useState({
    page: 1,
    limit: 10,
  });

  const getSchools = async () => {
    try {
      setLoading(true);
      const response = await getListSchool(filterSchool);
      if (response?.code === 200) {
        setLoading(false);
        setSchools(response?.data?.data);
      }
    } catch (e) {
      setLoading(false);
    }
  };

  const getCountryList = async () => {
    try {
      const response = await getCountries();
      if (response?.code === 200) {
        const options = changeArrayToOptions(response?.data?.countries);
        setCountries(options);
      }
    } catch (e) {
      /* empty */
    }
  };
  useEffect(() => {
    getSchools().then();
  }, [filterSchool]);

  useEffect(() => {
    getCountryList().then();
  }, []);
  return (
    <APIContext.Provider
      value={{
        schoolList,
        getSchools,
        loading,
        setFilterSchool,
        filterSchool,
        getCountryList,
        countries,
      }}
    >
      {children}
    </APIContext.Provider>
  );
};

export const useAPI = () => useContext(APIContext);
