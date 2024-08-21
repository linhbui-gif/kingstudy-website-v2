import React, { createContext, useState, useContext, useEffect } from 'react';

import { ETypeNotification } from '@/common/enums';
import { getListBlog } from '@/services/blog';
import { getCountries, getMajors } from '@/services/common';
import Helpers from '@/services/helpers';
import { getProfileUser } from '@/services/profile';
import {
  addSchoolCompareList,
  getListSchool,
  getListSchoolWishlist,
  getSchoolCompareList,
  removeSchoolCompareList,
} from '@/services/school';
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
  const [loadingGetSchoolCompareState, setLoadingSchoolCompareState] =
    useState(false);
  const [schoolCompare, setSchoolCompare] = useState([]);

  const [openDrawerCompare, setOpenDrawerCompare] = useState(false);
  const [blogs, setBlogs] = useState([]);
  const [loadingBlog, setLoadingBlog] = useState(false);
  const [loadingCountry, setLoadingCountry] = useState(false);
  const [idCategory, setIdCategory] = useState({});
  const showDrawerCompare = () => {
    setOpenDrawerCompare(true);
  };

  const onCloseCompare = () => {
    setOpenDrawerCompare(false);
  };
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
      setLoadingCountry(true);
      const response = await getCountries();
      if (response?.code === 200) {
        setLoadingCountry(false);
        const options = changeArrayToOptions(response?.data?.countries);
        setCountries(options);
      }
    } catch (e) {
      setLoadingCountry(true);
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

  const addSchoolCompare = async (idCompare) => {
    try {
      setLoadingSchoolCompareState(true);
      const res = await addSchoolCompareList(idCompare);
      if (res?.code === 200) {
        setLoadingSchoolCompareState(false);
        getSchoolCompare().then();
        showNotification(
          ETypeNotification.SUCCESS,
          'Thêm trường vào danh sách so sánh thành công'
        );
      }
    } catch (e) {
      showNotification(ETypeNotification.ERROR, e?.response?.data?.message);
      setLoadingSchoolCompareState(false);
    }
  };
  const getSchoolCompare = async () => {
    try {
      setLoadingSchoolCompareState(true);
      const res = await getSchoolCompareList();
      if (res?.code === 200) {
        setLoadingSchoolCompareState(false);
        setSchoolCompare(res?.data);
        setOpenDrawerCompare(true);
      }
    } catch (e) {
      setLoadingSchoolCompareState(false);
    }
  };
  const removeSchoolCompare = async (id) => {
    try {
      setLoadingSchoolCompareState(true);
      const res = await removeSchoolCompareList(id);
      if (res?.code === 200) {
        setLoadingSchoolCompareState(false);
        getSchoolCompare().then();
        showNotification(
          ETypeNotification.SUCCESS,
          'Xóa trường khỏi danh sách so sánh thành công!'
        );
      }
    } catch (e) {
      setLoadingSchoolCompareState(false);
    }
  };

  const getBlogList = async () => {
    try {
      setLoadingBlog(true);
      const response = await getListBlog(idCategory);
      if (response?.code === 200) {
        setLoadingBlog(false);
        setBlogs(response?.data);
      }
    } catch (e) {
      setLoadingBlog(true);
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
        addSchoolCompare,
        loadingGetSchoolCompareState,
        schoolCompare,
        openDrawerCompare,
        setOpenDrawerCompare,
        onCloseCompare,
        showDrawerCompare,
        getSchoolCompare,
        removeSchoolCompare,
        getBlogList,
        loadingBlog,
        blogs,
        setIdCategory,
        idCategory,
        loadingCountry,
      }}
    >
      {children}
    </APIContext.Provider>
  );
};

export const useAPI = () => useContext(APIContext);
