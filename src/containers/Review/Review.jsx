import { Progress } from 'antd';
import Image from 'next/image';

import { reviewPartner } from './Review.data';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
const Review = () => {
  const reviewRatings = [
    { percent: 98, stars: 5 },
    { percent: 78, stars: 4 },
    { percent: 55, stars: 3 },
    { percent: 60, stars: 2 },
    { percent: 10, stars: 1 },
  ];
  return (
    <section className={'py-[2rem] lg:py-[7rem]'}>
      <Container>
        <h2 className="text-title-20 leading-[120%] text-style-7">
          Đánh Giá Của Học Viên
        </h2>
        <div className="flex gap-x-[2.4rem] md:flex-nowrap flex-wrap ">
          <div className="md:w-[calc(16%)] lg:w-[calc(20%)] w-full md:mb-0 mb-4 text-center rounded-[0.5rem] border-custom border-solid border-style-8 p-[2rem]">
            <h2 className="text-title-56 leading-[6.5rem] text-style-34 mb-[2.1rem]">
              4.7
            </h2>
            <div className="flex items-center justify-center">
              {Array(5)
                .fill(0)
                .map((_, index) => (
                  <Icon key={index} name={EIconName.Star} />
                ))}
            </div>
            <p className="text-button-16 leading-[2.6rem] text-style-9 mt-[0.6rem] mb-0">
              5785 Rating
            </p>
          </div>
          <div className="flex flex-col w-full gap-y-[1.5rem]">
            {reviewRatings.map((rating, index) => (
              <div key={index} className="flex w-full gap-x-[3rem]">
                <div className="flex">
                  {Array(5)
                    .fill(0)
                    .map((_, starIndex) => (
                      <Icon
                        key={starIndex}
                        name={
                          starIndex < rating.stars
                            ? EIconName.Star
                            : EIconName.StarBorder
                        }
                      />
                    ))}
                </div>
                <Progress percent={rating.percent} strokeColor="#124694" />
              </div>
            ))}
          </div>
        </div>
        <div>
          {reviewPartner.map((review) => (
            <div
              key={review.id}
              className="review-content flex gap-x-[1rem] mt-[2rem] items-start"
            >
              <div className={'flex items-center justify-center '}>
                <Image
                  className={
                    'aspect-[1] lg:aspect-auto object-contain lg:object-fill'
                  }
                  src={review.url}
                  alt={review.alt}
                  loading={'lazy'}
                  quality={100}
                />
              </div>
              <div className="flex flex-col gap-y-[1rem]">
                <h3 className="text-button-16  text-style-7  leading-[140%] mb-0">
                  {review.name}
                </h3>
                <div className="flex gap-x-[1rem] items-center ">
                  <div className="flex ">
                    {Array(5)
                      .fill(0)
                      .map((_, index) => (
                        <Icon key={index} name={EIconName.Star} />
                      ))}
                  </div>
                  <span className="text-body-14 leading-[140%] text-style-7">
                    {review.time}
                  </span>
                </div>
                <p className="text-style-12 text-body-16 leading-[150%]">
                  {review.content}
                </p>
              </div>
            </div>
          ))}
        </div>
      </Container>
    </section>
  );
};
export default Review;
