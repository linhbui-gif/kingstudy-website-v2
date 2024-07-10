import React, { useEffect } from 'react';

import { Col, Row, Skeleton } from 'antd';
import Link from 'next/link';

import Meta from '@/components/Meta';
import CardNews from '@/containers/CardNews';
import Container from '@/containers/Container';
import HeroBannerCommon from '@/containers/HeroBannerCommon';
import SidebarNews from '@/containers/SidebarNews';
import { useAPI } from '@/contexts/APIContext';
import GuestLayout from '@/layouts/GuestLayout';

const Blog = () => {
  const { blogs, getBlogList, loadingBlog, idCategory } = useAPI();
  const loadingSkeleton = (
    <div className={'w-full card-new mb-[2rem] bg-white shadow-sm'}>
      <Skeleton.Image active />
      <div className={'p-[3rem]'}>
        <Skeleton.Input className={'mt-2'} active />
        <Skeleton.Input rootClassName={'mt-2 card-new-input'} active />
        <Skeleton.Input rootClassName={'mt-2 card-new-input'} active />
        <Skeleton.Input rootClassName={'mt-2 card-new-input'} active />
        <Skeleton.Input rootClassName={'mt-2 card-new-input'} active />
        <Skeleton.Input rootClassName={'mt-2 card-new-input'} active />
        <Skeleton.Input className={'mt-2'} active />
      </div>
    </div>
  );
  useEffect(() => {
    getBlogList().then();
  }, [idCategory]);
  return (
    <section>
      <HeroBannerCommon
        title={'Tin tức'}
        items={[
          {
            title: <Link href="/">Trang chủ</Link>,
          },
          {
            title: 'Danh sách bài viết',
          },
        ]}
      />
      <div className={'py-[9rem]'}>
        <Container>
          <Row gutter={[24, 24]}>
            <Col lg={{ span: 16 }}>
              {!blogs && (
                <p className={'text-title-20'}>Không có bài viết nào</p>
              )}
              {blogs &&
                blogs.map((element) => {
                  return loadingBlog ? (
                    loadingSkeleton
                  ) : (
                    <CardNews
                      key={element?.id}
                      data={element}
                      loading={loadingBlog}
                    />
                  );
                })}
            </Col>
            <Col lg={{ span: 8 }}>
              <SidebarNews />
            </Col>
          </Row>
        </Container>
      </div>
    </section>
  );
};

export default Blog;
Blog.getLayout = function (page) {
  return (
    <>
      <GuestLayout>
        <Meta title={'Danh sách bài viết'} />
        {page}
      </GuestLayout>
    </>
  );
};
