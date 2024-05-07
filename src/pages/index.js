import React, { useEffect, useState } from 'react';

import CardSkeleton from '@/components/Card/CardSkeleton';
import Meta from '@/components/Meta';
import TopBar from '@/containers/Topbar';
import { getListSchool } from '@/services/school';
import ButtonComponent from "@/components/Button";
import {EIconName} from "@/components/Icon/Icon.enum";

export default function Home() {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState([]);
  const [filter, setFilter] = useState({
    page: 1,
    limit: 15,
  });
  const getListSchools = async () => {
    try {
      setLoading(true);
      const response = await getListSchool(filter);
      if (response?.code === 200) {
        setLoading(false);
        // eslint-disable-next-line no-unsafe-optional-chaining
        setData((prev) => [...prev, ...response?.data?.data]);
      }
    } catch (e) {
      /* empty */
    }
  };
  useEffect(() => {
    getListSchools().then();
  }, [filter.page, filter.limit]);
  const LoadingSkeletonCards = () => {
    return <CardSkeleton />;
  };
  const onLoadMore = () => {
    setFilter((prev) => {
      return { ...filter, limit: 15, page: prev.page + 1 };
    });
  };
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <TopBar />
    </div>
  );
}
