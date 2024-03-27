import React, { useEffect, useRef, useState } from 'react';
import Slider from 'react-slick';

const Carousels = ({
  dots = true,
  arrows = true,
  infinite = true,
  slidesToShow = 1,
  slidesToScroll = 1,
  slidesPerRow = 1,
  adaptiveHeight = false,
  responsive = [],
  autoplay,
  variableWidth = false,
  focusOnSelect = false,
  children,
  onInit,
  onDragging,
  onBeforeChange,
  onAfterChange,
}) => {
  const SlickSlider = Slider;
  const [isReady, setIsReady] = useState(false);
  const slickRef = useRef(null);

  const settings = {
    speed: 500,
    dots,
    arrows,
    infinite,
    autoplay,
    slidesPerRow,
    adaptiveHeight,
    autoplaySpeed: 5000,
    slidesToShow,
    slidesToScroll,
    focusOnSelect,
    responsive,
    variableWidth,
    beforeChange: (oldIndex, newIndex) => {
      onDragging?.(true);
      onBeforeChange?.(oldIndex, newIndex);
    },
    afterChange: (newIndex) => {
      onDragging?.(false);
      onAfterChange?.(newIndex);
    },
  };

  useEffect(() => {
    if (slickRef?.current) {
      setIsReady(true);
      onInit?.(slickRef.current);
    }
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, [slickRef]);

  return (
    <div style={{ opacity: isReady ? 1 : 0 }}>
      <SlickSlider ref={slickRef} swipeToSlide {...settings}>
        {children}
      </SlickSlider>
    </div>
  );
};

export default Carousels;
