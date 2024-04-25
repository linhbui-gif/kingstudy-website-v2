import React, { useEffect, useState } from 'react';

import { Col, Row } from 'antd';

import Card from '@/components/Card';
import CardSkeleton from '@/components/Card/CardSkeleton';
import Meta from '@/components/Meta';
import { getListSchool } from '@/services/school';

export default function Home() {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState([]);
  const getListSchools = async () => {
    try {
      setLoading(true);
      const response = await getListSchool();
      if (response?.code === 200) {
        setLoading(false);
        setData(response?.data?.data);
      }
    } catch (e) {
      /* empty */
    }
  };
  useEffect(() => {
    getListSchools().then();
  }, []);
  const LoadingSkeletonCards = () => {
    return <CardSkeleton />;
  };
  return (
    <div className={`min-h-screen`}>
      <Meta title="KingStudy" />
      <div className="container px-5 mx-auto">
        <Row gutter={[24, 24]} className={'flex'}>
          {data &&
            data.map((element) => {
              return (
                <Col span={24} md={{ span: 6 }} key={element?.id}>
                  {loading ? LoadingSkeletonCards() : ''}
                  {!loading && (
                    <Card
                      url={'https://kingstudy.vn' + element?.logo}
                      title={element?.name}
                      description={element?.heading}
                      alt={element?.name}
                    />
                  )}
                </Col>
              );
            })}
        </Row>
      </div>
    </div>
  );
}
