import React, { useEffect, useState } from 'react';

import CardSkeleton from '@/components/Card/CardSkeleton';
import Meta from '@/components/Meta';
import TopBar from '@/containers/Topbar';
import { getListSchool } from '@/services/school';

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
      {/*<Row gutter={[24, 24]} className={'flex'}>*/}
      {/*  {data &&*/}
      {/*    data.map((element) => {*/}
      {/*      return (*/}
      {/*        <Col span={24} md={{ span: 6 }} key={element?.id}>*/}
      {/*          {loading ? LoadingSkeletonCards() : ''}*/}
      {/*          {!loading && (*/}
      {/*            <Card*/}
      {/*              url={'https://kingstudy.vn' + element?.logo}*/}
      {/*              title={element?.name}*/}
      {/*              description={element?.heading}*/}
      {/*              alt={element?.name}*/}
      {/*            />*/}
      {/*          )}*/}
      {/*        </Col>*/}
      {/*      );*/}
      {/*    })}*/}
      {/*  <Col span={24}>*/}
      {/*    <div className={'w-full flex items-center justify-center'}>*/}
      {/*      {' '}*/}
      {/*      <Button type={'primary'} onClick={onLoadMore}>*/}
      {/*        Load more*/}
      {/*      </Button>*/}
      {/*    </div>*/}
      {/*  </Col>*/}
      {/*</Row>*/}
    </div>
  );
}
