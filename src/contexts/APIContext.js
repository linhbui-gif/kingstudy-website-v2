import React, { createContext, useState, useContext, useEffect } from 'react';

import axios from 'axios';

import { getCountries, getMajors } from '@/services/common';
import Helpers from '@/services/helpers';
import { changeArrayToOptions } from '@/utils/utils';

const APIContext = createContext();

export const APIProvider = ({ children }) => {
  const [schoolList, setSchools] = useState([]);
  const [loading, setLoading] = useState(false);
  const [countries, setCountries] = useState([]);
  const [majors, setMajors] = useState([]);
  const [filterSchool, setFilterSchool] = useState({
    page: 1,
    limit: 15,
  });

  const [totalSchool, setTotalSchool] = useState(0);
  const isLogin = Helpers.getAccessToken();
  const getSchools = async () => {
    try {
      setLoading(true);
      const response = await axios.post(`/api/fetch-data`, {
        body: {
          params: filterSchool,
        },
      });
      if (response?.status === 200) {
        setLoading(false);
        setSchools(response?.data?.data?.data?.data);
        setTotalSchool(response?.data?.data?.data?.total);
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
  const getMajorList = async () => {
    try {
      const response = await getMajors();
      if (response?.code === 200) {
        setMajors(response?.data?.majors);
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

  useEffect(() => {
    getMajorList().then();
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
        majors,
        isLogin,
        totalSchool,
      }}
    >
      {children}
    </APIContext.Provider>
  );
};

export const useAPI = () => useContext(APIContext);
