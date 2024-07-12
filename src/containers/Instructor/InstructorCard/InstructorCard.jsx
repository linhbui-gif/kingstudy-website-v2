import Image from 'next/image';
import Link from 'next/link';

import ImageMember from '@/assets/images/image-member.jpg';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
const InstructorCard = () => {
  return (
    <div
      className={'shadow-sm rounded-sm'}
      style={{ border: '1px solid #edeef2' }}
    >
      <div className="body" style={{ borderBottom: '1px solid #edeef2' }}>
        <div className="item p-[3rem]">
          <div
            className={
              'w-[15rem] h-[15rem] overflow-hidden mb-[2rem] mx-auto rounded-full group'
            }
            style={{ border: '1px solid #edeef2' }}
          >
            <Image
              width={400}
              height={400}
              src={ImageMember}
              alt={'/'}
              layout={'responsive'}
              loading={'lazy'}
              className={'transition ease-in-out group-hover:scale-[1.1]'}
            />
          </div>
          <div className="member-content">
            <h4 className={'text-center text-title-20'}>Bùi Mỹ Linh</h4>
            <p className={'text-center text-body-14'}>Chuyên viên tư vấn</p>
          </div>
          <div className="member-social">
            <ul className={'flex items-center justify-center gap-3'}>
              <li>
                <Link
                  href={'/'}
                  className={
                    'flex items-center justify-center w-[3rem] h-[3rem] rounded-sm text-center bg-style-10'
                  }
                >
                  <Icon name={EIconName.Facebook} />
                </Link>
              </li>
              <li>
                <Link
                  href={'/'}
                  className={
                    'flex items-center justify-center w-[3rem] h-[3rem] rounded-sm text-center bg-style-10'
                  }
                >
                  <Icon name={EIconName.Twitter} />
                </Link>
              </li>
              <li>
                <Link
                  href={'/'}
                  className={
                    'flex items-center justify-center w-[3rem] h-[3rem] rounded-sm text-center bg-style-10'
                  }
                >
                  <Icon name={EIconName.Instagram} />
                </Link>
              </li>
              <li>
                <Link
                  href={'/'}
                  className={
                    'flex items-center justify-center w-[3rem] h-[3rem] rounded-sm text-center bg-style-10'
                  }
                >
                  <Icon name={EIconName.Likedine} />
                </Link>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div className="meta flex items-center justify-between p-[1rem_3rem]">
        <div className="rateting flex items-center gap-2">
          <Icon name={EIconName.Star} />
          <span>4.9 (56k+)</span>
        </div>
        <div className="rateting flex items-center">
          <Icon name={EIconName.Check} />
          <span>15 Courses</span>
        </div>
      </div>
    </div>
  );
};
export default InstructorCard;
