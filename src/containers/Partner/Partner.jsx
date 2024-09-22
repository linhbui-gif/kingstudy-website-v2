import Image from 'next/image';
import { useMediaQuery } from 'react-responsive';

import Carousels from '@/components/Carousels';
import Container from '@/containers/Container';
import { imagesPartner } from '@/containers/Partner/Partner.data';

const Partner = () => {
  const isMobile = useMediaQuery({ maxWidth: 767 });
  return (
    <section className={'py-[2rem] lg:py-[7rem]'}>
      <Container>
        <Carousels
          className={'partners-carousel'}
          slidesToShow={6}
          responsive={[
            {
              breakpoint: 992,
              settings: {
                slidesToShow: 5,
                slidesToScroll: 5,
                infinite: true,
                autoplay: true,
                dots: false,
              },
            },
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                autoplay: true,
                dots: false,
              },
            },
          ]}
        >
          {imagesPartner.map((image) => (
            <div className={'partners'} key={image.id}>
              <div className={'flex items-center justify-center '}>
                <Image
                  className={
                    'aspect-[70/48] lg:aspect-auto object-contain lg:object-fill'
                  }
                  src={image.url}
                  alt={`${image.alt}`}
                  layout={`${isMobile ? 'responsive' : 'fix'}`}
                  loading={'lazy'}
                  quality={100}
                />
              </div>
            </div>
          ))}
        </Carousels>
      </Container>
    </section>
  );
};
export default Partner;
