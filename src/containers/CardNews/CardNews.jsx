import moment from 'moment';
import Image from 'next/image';
import Link from 'next/link';

import { EFormat } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import { Paths } from '@/routers/constants';
import { rootUrl } from '@/utils/utils';
import React from "react";
import dynamic from "next/dynamic";
const MediaQuery = dynamic(() => import('react-responsive'), {
  ssr: false,
});
const CardNews = ({ data, key }) => {
  return (
    <>
      <div className={'rounded-sm mb-[2rem]'} key={key}>
        <div className={'w-full overflow-hidden'}>
          <Link
            href={`${Paths.Blog.BlogDetail(data?.alias)}`}
            className={'w-full block'}
          >
            <MediaQuery maxWidth={991}>
              <Image
                src={rootUrl + data?.image_location}
                alt={data?.title}
                loading={'lazy'}
                layout={'fix'}
                width={500}
                height={500}
                className={'w-full block object-cover h-full rounded-sm'}
                quality={100}
              />
            </MediaQuery>
            <MediaQuery minWidth={992}>
              <Image
                src={rootUrl + data?.image_location}
                alt={data?.title}
                loading={'lazy'}
                layout={'responsive'}
                width={500}
                height={500}
                className={'w-full block object-cover h-full rounded-sm'}
                quality={100}
              />
            </MediaQuery>
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
          <h3 className={'text-title-24'}>
            <Link
              href={`${Paths.Blog.BlogDetail(data?.alias)}`}
              className={'text-style-7'}
            >
              {data?.title}
            </Link>
          </h3>
          <p className={'text-style-9 leading-9 mb-[1.5rem] text-body-14'}>
            {data?.description}
          </p>
          <ButtonComponent
            title={'Đọc thêm'}
            className={'primary-outline w-[15rem]'}
            link={`${Paths.Blog.BlogDetail(data?.alias)}`}
          />
        </div>
      </div>
    </>
  );
};
export default CardNews;
