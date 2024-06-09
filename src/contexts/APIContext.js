import React, { createContext, useState, useContext, useEffect } from 'react';

import { ETypeNotification } from '@/common/enums';
import { getCountries, getMajors } from '@/services/common';
import Helpers from '@/services/helpers';
import { getProfileUser } from '@/services/profile';
import { getListSchool, getListSchoolWishlist } from '@/services/school';
import { showNotification } from '@/utils/function';
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
  const [profileState, setProfileState] = useState(null);
  const [loadingGetProfileState, setLoadingProfileState] = useState(false);
  const [loadingGetSchoolWishListState, setLoadingSchoolWishListState] =
    useState(false);
  const [schoolWishList, setSchoolWishList] = useState([]);
  const getSchools = async () => {
    try {
      setLoading(true);
      const response = await getListSchool(filterSchool);
      if (response?.code === 200) {
        setLoading(false);
        setSchools(response?.data?.data);
        setTotalSchool(response?.data?.total);
      }
    } catch (e) {
      setLoading(false);
      showNotification(
        ETypeNotification.ERROR,
        'Đã xảy ra lỗi hệ thống ! Vui lòng liên hệ kỹ thuật để được hỗ trợ sớm nhất'
      );
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
      showNotification(
        ETypeNotification.ERROR,
        'Đã xảy ra lỗi hệ thống ! Vui lòng liên hệ kỹ thuật để được hỗ trợ sớm nhất'
      );
    }
  };
  const getMajorList = async () => {
    try {
      const response = await getMajors();
      if (response?.code === 200) {
        setMajors(response?.data?.majors);
      }
    } catch (e) {
      showNotification(
        ETypeNotification.ERROR,
        'Đã xảy ra lỗi hệ thống ! Vui lòng liên hệ kỹ thuật để được hỗ trợ sớm nhất'
      );
    }
  };
  const getProfileInfor = async () => {
    try {
      setLoadingProfileState(true);
      const response = await getProfileUser();
      if (response?.status === 200) {
        setLoadingProfileState(false);
        setProfileState(response?.data);
      }
    } catch (e) {
      setLoadingProfileState(false);
      showNotification(
        ETypeNotification.ERROR,
        'Đã xảy ra lỗi hệ thống ! Vui lòng liên hệ kỹ thuật để được hỗ trợ sớm nhất'
      );
    }
  };

  const getSchoolWishList = async () => {
    try {
      setLoadingSchoolWishListState(true);
      const res = await getListSchoolWishlist();
      if (res?.status === 200) {
        setLoadingSchoolWishListState(false);
        setSchoolWishList(res?.data);
      }
    } catch (e) {
      setLoadingSchoolWishListState(false);
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
        getProfileInfor,
        profileState,
        loadingGetProfileState,
        getSchoolWishList,
        schoolWishList,
        loadingGetSchoolWishListState,
      }}
    >
      {children}
    </APIContext.Provider>
  );
};

export const useAPI = () => useContext(APIContext);
