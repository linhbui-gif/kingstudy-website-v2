import React, { useEffect, useState } from 'react';

import { Col, Row, Skeleton } from 'antd';
import Link from 'next/link';

import Meta from '@/components/Meta';
import CardEvent from '@/containers/CardEvent';
import Container from '@/containers/Container';
import HeroBannerCommon from '@/containers/HeroBannerCommon';
import GuestLayout from '@/layouts/GuestLayout';
import { getListBlogEvent } from '@/services/blog';

const Event = () => {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(false);
  const loadingSkeleton = (
    <>
      <div
        className={
          'card-event flex gap-[25px] p-[2.5rem] bg-[#f6f8fb] md:flex-nowrap flex-wrap rounded-sm'
        }
      >
        <Skeleton.Image active />
        <div className={'card-new-input'}>
          <div className={'mb-[2rem]'}>
            <Skeleton.Input active />
          </div>
          <div>
            <Skeleton.Input active />
          </div>
        </div>
      </div>
    </>
  );
  const getBlogList = async () => {
    try {
      setLoading(true);
      const response = await getListBlogEvent({});
      if (response?.code === 200) {
        setLoading(false);
        setData(response?.data);
      }
    } catch (e) {
      setLoading(true);
    }
  };
  useEffect(() => {
    getBlogList().then();
  }, []);
  return (
    <section>
      <HeroBannerCommon
        title={'Sự kiện'}
        items={[
          {
            title: <Link href="/">Trang chủ</Link>,
          },
          {
            title: 'Danh sách sự kiện',
          },
        ]}
        urlBanner={'/images/image-banner-event.jpg'}
      />
      <div className={'py-[9rem]'}>
        <Container>
          <Row gutter={[24, 24]}>
            {data &&
              data.map((element) => {
                return (
                  <Col lg={{ span: 12 }} key={element?.id}>
                    {loading ? loadingSkeleton : <CardEvent data={element} />}
                  </Col>
                );
              })}
          </Row>
        </Container>
      </div>
    </section>
  );
};
export default Event;
Event.getLayout = function (page) {
  return (
    <>
      <GuestLayout>
        <Meta title={'Danh sách sự kiện'} />
        {page}
      </GuestLayout>
    </>
  );
};
