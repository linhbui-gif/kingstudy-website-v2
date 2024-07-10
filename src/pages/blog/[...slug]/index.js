import { useEffect, useState } from 'react';

import { Col, Row, Spin } from 'antd';
import * as cheerio from 'cheerio';
import DOMPurify from 'isomorphic-dompurify';
import moment from 'moment/moment';
import Image from 'next/image';
import Link from 'next/link';
import { useRouter } from 'next/router';

import { EFormat } from '@/common/enums';
import Meta from '@/components/Meta';
import Container from '@/containers/Container';
import SidebarNews from '@/containers/SidebarNews';
import GuestLayout from '@/layouts/GuestLayout';
import { Paths } from '@/routers/constants';
import { getBlogBySlug } from '@/services/blog';
import { rootUrl } from '@/utils/utils';
const BlogDetail = () => {
  const router = useRouter();
  const { slug } = router.query;
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(false);
  const getBlog = async () => {
    try {
      setLoading(true);
      const response = await getBlogBySlug(slug[0]);
      if (response?.code === 200) {
        setLoading(false);
        let content = response?.data?.content;
        const $ = cheerio.load(content);
        $('img').each((index, element) => {
          const src = $(element).attr('src');
          const newSrc = `${rootUrl}${src}`;
          $(element).attr('src', newSrc);
        });

        content = $.html();
        setData({ ...response.data, content });
      }
    } catch (e) {
      setLoading(false);
    }
  };
  useEffect(() => {
    if (!slug) return;
    getBlog().then();
  }, [slug]);
  const cleanHTML = DOMPurify.sanitize(data?.content);
  return (
    <GuestLayout>
      <Meta title={data?.title} />
      <section className={'py-[9rem]'}>
        <Container>
          <Row gutter={[24, 24]}>
            <Col lg={{ span: 16 }}>
              <div className={'rounded-sm mb-[2rem]'}>
                <Spin spinning={loading}>
                  <div className={'w-full overflow-hidden'}>
                    <Link
                      href={`${Paths.Blog.BlogDetail('chi-tiet')}`}
                      className={'w-full block h-[50rem]'}
                    >
                      <Image
                        src={
                          data?.image_location
                            ? rootUrl + data?.image_location
                            : '/'
                        }
                        alt={data?.title}
                        loading={'lazy'}
                        layout={'fix'}
                        width={600}
                        height={500}
                        className={
                          'w-full block object-cover h-full rounded-sm'
                        }
                      />
                    </Link>
                  </div>
                  <div
                    className={'p-[3rem] bg-white shadow-md'}
                    style={{ borderRadius: '0 0 4px 4px' }}
                  >
                    <ul className={'flex items-center gap-[20px] mb-[1.5rem]'}>
                      <li className={'text-style-9'}>
                        {moment(data?.created_at).format(EFormat['YYYY-MM-DD'])}
                      </li>
                      <li className={'text-style-9'}>
                        {moment(data?.created_at).format(EFormat['HH:mm'])}
                      </li>
                    </ul>
                    <h3 className={'text-title-24'}>{data?.title}</h3>
                    <div
                      className={'font-BeVnPro-style-content'}
                      dangerouslySetInnerHTML={{
                        __html: cleanHTML,
                      }}
                      style={{ color: '#575757 !important' }}
                    />
                  </div>
                </Spin>
              </div>
            </Col>
            <Col lg={{ span: 8 }}>
              <SidebarNews />
            </Col>
          </Row>
        </Container>
      </section>
    </GuestLayout>
  );
};
export default BlogDetail;
