import React from 'react';

import { Col, Row } from 'antd';

import ImageSchool from '@/assets/images/image-school.jpg';
import Card from '@/components/Card';
import CardSkeleton from '@/components/Card/CardSkeleton';
import Empty from '@/components/Empty';
import { useAPI } from '@/contexts/APIContext';

const SchoolFavorite = () => {
  const { schoolList, loading } = useAPI();
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>
        Danh sách trường yêu thích
      </h4>
      <Row gutter={[24, 24]}>
        {schoolList.length === 0 ? (
          <Col span={24}>
            <div className={'flex items-center justify-center flex-col'}>
              <Empty />
            </div>
          </Col>
        ) : (
          ''
        )}
        {schoolList &&
          schoolList.map((school) => {
            return (
              <Col
                className="flex flex-col "
                span={24}
                xl={{ span: 8 }}
                lg={{ span: 12 }}
                md={{ span: 12 }}
                key={school?.id}
              >
                {loading ? (
                  <CardSkeleton />
                ) : (
                  <Card
                    url={ImageSchool}
                    title={school?.name}
                    alt={school?.name}
                    type={school?.type_school}
                    country={school?.country}
                    slug={school?.slug}
                  />
                )}
              </Col>
            );
          })}
      </Row>
    </div>
  );
};
export default SchoolFavorite;
