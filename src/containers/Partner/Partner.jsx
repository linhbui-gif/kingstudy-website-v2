import Image from 'next/image';

import Academy from '@/assets/images/Academy.png';
import Bookstar from '@/assets/images/Bookstar.png';
import Highgill from '@/assets/images/HighhillAcademy.png';
import University from '@/assets/images/University.png';
import UniversityCurrent from '@/assets/images/UniversityCurrent.png';
import Carousels from '@/components/Carousels';
import Container from '@/containers/Container';

const Partner = () => {
  const images = [
    {
      id: 1,
      url: University,
      alt: 'University established in 1930',
    },
    {
      id: 2,
      url: Bookstar,
      alt: 'Bookstar tag line goes here',
    },
    {
      id: 3,
      url: UniversityCurrent,
      alt: 'University introduction',
    },
    {
      id: 4,
      url: Highgill,
      alt: 'Highhill academy',
    },
    {
      id: 5,
      url: Academy,
      alt: 'Introduction academy',
    },
    {
      id: 6,
      url: Academy,
      alt: 'Introduction academy',
    },
    {
      id: 7,
      url: Academy,
      alt: 'Introduction academy',
    },
    {
      id: 8,
      url: Academy,
      alt: 'Introduction academy',
    },
  ];
  return (
    <section className={'py-[2rem] lg:py-[7rem]'}>
      <Container>
        <Carousels
          className={'partners-carousel'}
          slidesToShow={6}
          responsive={[
            {
              breakpoint: 575,
              settings: {
                slidesToShow: 4,
                slidesToScroll: 4,
                infinite: false,
                dots: false,
              },
            },
          ]}
        >
          {images.map((image) => (
            <div className={'partners'} key={image.id}>
              <div
                className={
                  'mx-auto lg:mx-0 lg:w-[12.6rem] lg:h-[11.9rem] w-[7rem] h-[4.8rem]'
                }
              >
                <Image
                  className={
                    'aspect-[70/48] lg:aspect-[126/119] object-contain'
                  }
                  src={image.url}
                  alt={`${image.alt}`}
                  layout={'responsive'}
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
