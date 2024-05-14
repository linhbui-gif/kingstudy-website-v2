import React, { useState } from 'react';

import { Col, Row } from 'antd';
import { useRouter } from 'next/router';

import Icon from '@/components/Icon';
import { EIconColor } from '@/components/Icon/Icon.enum';
import Container from '@/containers/Container';
import { useAPI } from '@/contexts/APIContext';
import { Paths } from '@/routers/constants';
const Major = () => {
  const router = useRouter();
  const [hoveredIndex, setHoveredIndex] = useState(null);
  const { majors, setFilterSchool } = useAPI();
  const handleMouseEnter = (index) => {
    setHoveredIndex(index);
  };

  const handleMouseLeave = () => {
    setHoveredIndex(null);
  };
  const handleClickMajor = (id) => {
    setFilterSchool({
      page: 1,
      limit: 10,
    });
    router.push(`${Paths.SchoolFilter(id)}`);
  };
  return (
    <section className={'lg:py-[7rem] py-[2rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col span={24}>
            <h2
              className={
                'lg:text-title-36 text-[2rem] font-[700] text-style-7 text-center'
              }
            >
              Các Ngành Học Nổi Bật
            </h2>
          </Col>
          {majors &&
            majors.map((major, index) => {
              const isHovered = hoveredIndex === index;
              return (
                <Col
                  span={24}
                  md={{ span: 12 }}
                  lg={{ span: 8 }}
                  key={major?.id}
                  onClick={() => handleClickMajor(major?.id)}
                >
                  <div
                    className={
                      'Major-item flex items-center gap-[2.4rem] p-[2.4rem_3.2rem] border border-solid border-style-8 rounded-sm transition group hover:bg-style-10 cursor-pointer'
                    }
                    onMouseEnter={() => handleMouseEnter(index)}
                    onMouseLeave={handleMouseLeave}
                  >
                    <Icon
                      name={major?.icon_name}
                      color={
                        !isHovered ? EIconColor.STYLE_10 : EIconColor.WHITE
                      }
                    />
                    <span
                      className={
                        'lg:text-title-24 text-body-14 font-[600] text-style-7 group-hover:text-white'
                      }
                    >
                      {major.name}
                    </span>
                  </div>
                </Col>
              );
            })}
        </Row>
      </Container>
    </section>
  );
};
export default Major;
