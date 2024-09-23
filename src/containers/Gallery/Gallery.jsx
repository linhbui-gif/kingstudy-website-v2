import React, { useState } from 'react';

import { Col, Row } from 'antd';
import SkeletonImage from 'antd/es/skeleton/Image';
import Image from 'next/image';
import Lightbox from 'react-image-lightbox';

import { rootUrl } from '@/utils/utils';
import 'react-image-lightbox/style.css';
const Gallery = ({ gallery = {}, loading = false }) => {
  const [photoIndex, setPhotoIndex] = useState(0);
  const [isOpen, setOpen] = useState(false);
  const images =
    Object.values(gallery) &&
    Object.values(gallery).map((element) => {
      return `${rootUrl}${element?.image}`;
    });
  const handleOpenLightbox = (index) => {
    setOpen(true);
    setPhotoIndex(index);
  };
  return (
    <div className={'pt-[4rem]'} id={'gallery'}>
      <h4 className={'mb-[1.6rem] text-title-20 text-style-7'}>Thư viện ảnh</h4>
      <Row gutter={[24, 24]}>
        {Object.values(gallery) &&
          Object.values(gallery).map((gallery, index) => {
            return (
              <Col md={{ span: 8 }} span={24} key={gallery?.id}>
                {loading ? (
                  <div className={'skeleton-image-school'}>
                    <SkeletonImage active />
                  </div>
                ) : (
                  <Image
                    onClick={() => handleOpenLightbox(index)}
                    src={`${rootUrl}${gallery?.image}`}
                    alt={''}
                    loading={'lazy'}
                    layout={'responsive'}
                    width={256}
                    height={137}
                    quality={100}
                    className={'rounded-sm cursor-pointer'}
                  />
                )}
              </Col>
            );
          })}
        {isOpen && (
          <Lightbox
            mainSrc={images[photoIndex]}
            nextSrc={images[(photoIndex + 1) % images.length]}
            prevSrc={images[(photoIndex + images.length - 1) % images.length]}
            onCloseRequest={() => {
              setOpen(false);
              setPhotoIndex(0);
            }}
            onMovePrevRequest={() =>
              setPhotoIndex((photoIndex + images.length - 1) % images.length)
            }
            onMoveNextRequest={() =>
              setPhotoIndex((photoIndex + 1) % images.length)
            }
          />
        )}
      </Row>
    </div>
  );
};
export default Gallery;
