import Image from 'next/image';

import Academy from '@/assets/images/Academy.png';
import Bookstar from '@/assets/images/Bookstar.png';
import Highgill from '@/assets/images/HighhillAcademy.png';
import University from '@/assets/images/University.png';
import UniversityCurrent from '@/assets/images/UniversityCurrent.png';
import Carousels from '@/components/Carousels';

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
  ];
  return (
    <Carousels
      className={'partners-carousel'}
      dots={false}
      autoplay={true}
      infinitive={false}
      slidesToShow={images.length - 1}
      responsive={[
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 640,
          settings: {
            slidesToShow: 3,
          },
        },
        {
          breakpoint: 320,
          settings: {
            slidesToShow: 3,
          },
        },
      ]}
    >
      {images.map((image) => (
        <div className={'partners'} key={image.id}>
          <Image
            className={'partners-item'}
            layout={'fixed'}
            loading={'lazy'}
            src={image.url}
            alt={`${image.alt}`}
            priority={image.priority}
          />
        </div>
      ))}
    </Carousels>
  );
};
export default Partner;
