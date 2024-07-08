import moment from 'moment/moment';
import Image from 'next/image';
import Link from 'next/link';

import { EFormat } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import { Paths } from '@/routers/constants';
import { rootUrl } from '@/utils/utils';
const CardEvent = ({ data }) => {
  return (
    <>
      <div
        className={
          'flex gap-[25px] p-[2.5rem] bg-[#f6f8fb] md:flex-nowrap flex-wrap rounded-sm'
        }
      >
        <div
          className={'lg:min-w-[23rem] lg:w-[23rem] w-full aspect-[500/600]'}
        >
          <Link href={`${Paths.Blog.BlogDetail(data?.alias)}`}>
            <Image
              src={rootUrl + data?.image_location}
              alt={data?.title}
              loading={'lazy'}
              layout={'responsive'}
              width={500}
              height={600}
              className={'object-cover rounded-sm'}
            />
          </Link>
        </div>
        <div>
          <h3 className={'text-title-24'}>
            <Link
              href={`${Paths.Blog.BlogDetail(data?.alias)}`}
              className={'text-style-7'}
            >
              {data?.title}
            </Link>
          </h3>
          <ul className={'flex items-center gap-[20px] mb-[1.5rem]'}>
            <li className={'text-style-9'}>
              {moment(data?.created_at).format(EFormat['YYYY-MM-DD'])}2
            </li>
            <li className={'text-style-9'}>
              {moment(data?.created_at).format(EFormat['HH:mm'])}
            </li>
          </ul>
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
export default CardEvent;
