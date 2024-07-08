import { useEffect, useState } from 'react';

import { Col, Row, Skeleton } from 'antd';

import Meta from '@/components/Meta';
import CardNews from '@/containers/CardNews';
import Container from '@/containers/Container';
import SidebarNews from '@/containers/SidebarNews';
import GuestLayout from '@/layouts/GuestLayout';
import { getListBlog } from '@/services/blog';

const Blog = () => {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(false);
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
  const getBlogList = async () => {
    try {
      setLoading(true);
      const response = await getListBlog({});
      if (response?.code === 200) {
        setLoading(false);
        setData(response?.data?.data);
      }
    } catch (e) {
      setLoading(true);
    }
  };
  useEffect(() => {
    getBlogList().then();
  }, []);
  return (
    <section className={'py-[9rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col lg={{ span: 16 }}>
            {data &&
              data.map((element) => {
                return loading ? (
                  loadingSkeleton
                ) : (
                  <CardNews
                    key={element?.id}
                    data={element}
                    loading={loading}
                  />
                );
              })}
          </Col>
          <Col lg={{ span: 8 }}>
            <SidebarNews data={data} loading={loading} />
          </Col>
        </Row>
      </Container>
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
