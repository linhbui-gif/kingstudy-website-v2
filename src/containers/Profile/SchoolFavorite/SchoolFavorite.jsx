import React, { useEffect } from 'react';

import { Col, Row } from 'antd';

import ImageSchool from '@/assets/images/image-school.jpg';
import Card from '@/components/Card';
import CardSkeleton from '@/components/Card/CardSkeleton';
import Empty from '@/components/Empty';
import { useAPI } from '@/contexts/APIContext';

const SchoolFavorite = () => {
  const { schoolWishList, getSchoolWishList, loadingGetSchoolWishListState } =
    useAPI();
  useEffect(() => {
    getSchoolWishList().then();
  }, []);
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>
        Danh sách trường yêu thích
      </h4>
      <Row gutter={[24, 24]}>
        {schoolWishList[0].length === 0 ? (
          <Col span={24}>
            <div className={'flex items-center justify-center flex-col'}>
              <Empty />
            </div>
          </Col>
        ) : (
          ''
        )}
        {schoolWishList[0] &&
          schoolWishList[0].map((school) => {
            return (
              <Col
                className="flex flex-col "
                span={24}
                xl={{ span: 8 }}
                lg={{ span: 12 }}
                md={{ span: 12 }}
                key={school?.id}
              >
                {loadingGetSchoolWishListState ? (
                  <CardSkeleton />
                ) : (
                  <Card
                    url={ImageSchool}
                    title={school?.name}
                    alt={school?.name}
                    type={school?.type_school}
                    country={school?.country}
                    slug={school?.slug}
                    id={school?.id}
                    isFavoritePage
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
