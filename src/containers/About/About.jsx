import { Col, Row } from 'antd';
import Image from 'next/image';

import ImageAbout from '@/assets/images/image-about.jpg';
import ImageAboutIconCheck from '@/assets/images/image-checked-about.svg';
import ButtonComponent from '@/components/Button';
import Container from '@/containers/Container';
const About = () => {
  return (
    <section className={'lg:py-[7rem] py-[2rem]'}>
      <Container>
        <Row gutter={[24, 24]}>
          <Col lg={{ span: 10, order: 1 }} span={24} order={1}>
            <h3
              className={
                'lg:text-title-36 text-[2rem] font-[700] text-style-7 lg:mb-[7rem] mb-[1.8rem] lg:text-left text-center'
              }
            >
              Chào Mừng Tới KingStudy
            </h3>
            <div
              className={
                'text-body-16 text-style-12 lg:max-w-[50rem] leading-9'
              }
            >
              <p>
                Hơn 10 năm hoạt động trong lĩnh vực du học, KingStudy tự hào là
                người bạn đồng hành, giúp đỡ học sinh, sinh viên Việt Nam thực
                hiện hóa giấc mơ du học.
              </p>
              <p>
                Mô hình ONE - STOP - STATION (một trạm) của KingStudy với sự
                tinh gọn về mặt lộ trình và thời gian xử lý công việc, giúp bạn
                chạm tới nền giáo dục quốc tế mơ ước mà không cần đến đơn vị thứ
                3 hỗ trợ
              </p>
              <ul className={'pl-0 mt-[2rem]'}>
                <li className={'flex items-center gap-x-[1rem] mb-[2rem]'}>
                  {' '}
                  <Image src={ImageAboutIconCheck} alt={''} />
                  Hỗ trợ hồ sơ du học <strong>HOÀN TOÀN MIỄN PHÍ</strong>
                </li>

                <li className={'flex items-center gap-x-[1rem] mb-[2rem]'}>
                  <Image src={ImageAboutIconCheck} alt={''} />
                  <span>
                    Quy trình <strong>10 BƯỚC</strong> chuẩn bị hồ sơ nhanh
                    chóng và hiệu quả
                  </span>
                </li>

                <li className={'flex items-center gap-x-[1rem]'}>
                  {' '}
                  <Image src={ImageAboutIconCheck} alt={''} />
                  <span>
                    <strong>MENTOR 1-1</strong> hướng dẫn viết LOR, SOP, CV,...
                    và luyện phỏng vấn học bổng
                  </span>
                </li>
              </ul>
              <div className={'flex justify-center lg:justify-start'}>
                <ButtonComponent
                  title={'Tìm hiểu thêm'}
                  className={'primary-outline mt-[4rem]'}
                  loading={false}
                />
              </div>
            </div>
          </Col>
          <Col lg={{ span: 14, order: 2 }} span={24} order={2}>
            <Image
              quality={100}
              loading={'lazy'}
              src={ImageAbout}
              alt={'about'}
              layout={'responsive'}
            />
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default About;
