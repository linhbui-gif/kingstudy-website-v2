import { useEffect, useState } from 'react';

import { Skeleton } from 'antd';
import moment from 'moment';
import Image from 'next/image';
import Link from 'next/link';
import { useRouter } from 'next/router';

import { EFormat } from '@/common/enums';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import { useAPI } from '@/contexts/APIContext';
import { Paths } from '@/routers/constants';
import { getListCategory } from '@/services/blog';
import { rootUrl } from '@/utils/utils';

const SidebarNews = () => {
  const router = useRouter();
  const { blogs, loadingBlog, setIdCategory } = useAPI();
  const [categories, setCategories] = useState([]);
  const [loadingCategory, setLoadingCategory] = useState(false);
  const blogListSixItem = blogs.slice(-6);
  const getCategories = async () => {
    try {
      setLoadingCategory(true);
      const response = await getListCategory();
      if (response?.code === 200) {
        setLoadingCategory(false);
        setCategories(response?.data);
      }
    } catch (e) {
      setLoadingCategory(true);
    }
  };
  useEffect(() => {
    getCategories().then();
  }, []);
  const skeletonLoadingCard = (
    <>
      <div className={'flex mb-[2rem]'}>
        <Skeleton.Image active />
        <div className={'flex flex-col gap-5 flex-1 pl-[2rem]'}>
          <Skeleton.Input active />
          <Skeleton.Input active />
        </div>
      </div>
      <div className={'flex mb-[2rem]'}>
        <Skeleton.Image active />
        <div className={'flex flex-col gap-5 flex-1 pl-[2rem]'}>
          <Skeleton.Input active />
          <Skeleton.Input active />
        </div>
      </div>
      <div className={'flex mb-[2rem]'}>
        <Skeleton.Image active />
        <div className={'flex flex-col gap-5 flex-1 pl-[2rem]'}>
          <Skeleton.Input active />
          <Skeleton.Input active />
        </div>
      </div>
    </>
  );
  const loadingSkeletonCategory = (
    <>
      <div>
        <div className={'mb-2'}>
          <Skeleton.Input />
        </div>
        <div className={'mb-2'}>
          <Skeleton.Input />
        </div>
        <div className={'mb-2'}>
          <Skeleton.Input />
        </div>
        <div className={'mb-2'}>
          <Skeleton.Input />
        </div>
      </div>
    </>
  );
  return (
    <aside className={'hidden md:block'}>
      <div className={'mb-[3rem]'}>
        <Input
          className={'input-suffix w-full'}
          placeholder={'Tìm bài viết...'}
          suffix={
            <Icon
              className={
                'absolute top-[50%] right-[1rem] translate-y-[-50%] flex items-center justify-center w-[3.2rem] h-[3.2rem] md:w-[4.2rem] md:h-[4.2rem] cursor-pointer'
              }
              name={EIconName.Search}
            />
          }
        />
      </div>
      <div
        className={
          'p-[2rem] mb-[3rem] bg-white border border-solid border-style-8 rounded-sm shadow-sm'
        }
      >
        <h4 className={'text-title-20 mb-[3.5rem]'}>Bài viết mới nhất</h4>
        <div className="content-sidebar">
          {loadingBlog && skeletonLoadingCard}
          {!loadingBlog && (
            <>
              {blogListSixItem &&
                blogListSixItem.map((element) => {
                  return (
                    <div
                      className={'flex items-center mb-[2rem]'}
                      key={element?.id}
                    >
                      <div className={'w-[7rem]'}>
                        <Image
                          src={rootUrl + element?.image_location}
                          alt={element?.title}
                          loading={'lazy'}
                          layout={'responsive'}
                          height={90}
                          width={70}
                          className={
                            'block w-full h-full object-cover rounded-sm'
                          }
                          quality={100}
                        />
                      </div>
                      <div className={'flex-1 pl-[2rem]'}>
                        <span className={'block w-full text-style-9 mb-[1rem]'}>
                          {moment(element?.created_at).format(
                            EFormat['YYYY-MM-DD']
                          )}
                        </span>
                        <h6 className={'text-body-16 font-[700]'}>
                          <Link
                            href={`${Paths.Blog.BlogDetail(element?.alias)}`}
                            className={'text-style-7 leading-9'}
                          >
                            {element?.title}
                          </Link>
                        </h6>
                      </div>
                    </div>
                  );
                })}
            </>
          )}
        </div>
      </div>
      <div
        className={
          'p-[2rem] bg-white border border-solid border-style-8 rounded-sm shadow-sm'
        }
      >
        <h4 className={'text-title-20 mb-[3.5rem]'}>Danh mục</h4>
        <ul>
          {loadingCategory && loadingSkeletonCategory}
          {!loadingCategory &&
            categories &&
            categories.map((element) => {
              return (
                <li
                  className={'mb-[1.5rem]'}
                  key={element?.id}
                  onClick={() => {
                    setIdCategory({ id: element?.id });
                    router.push(`${Paths.Blog.View}`);
                  }}
                >
                  <span
                    className={
                      'relative cursor-pointer pl-[2rem] text-style-9 text-body-14 after:absolute after:content-[""] after:left-0 after:top-[6px] after:w-[6px] after:h-[6px] after:rounded-full after:bg-style-12'
                    }
                  >
                    {element?.name}
                  </span>
                </li>
              );
            })}
        </ul>
      </div>
    </aside>
  );
};
export default SidebarNews;
