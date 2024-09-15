import React from 'react';

import { Col, Form, Row } from 'antd';
import Image from 'next/image';
import Link from 'next/link';

import ImageLogo from '@/assets/images/image-logo-mobile.png';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import Container from '@/containers/Container';
const Footer = () => {
  return (
    <footer
      className={`footer bg-style-32 pt-[5rem] pb-[10rem] lg:pb-0 lg:pt-[10rem]`}
    >
      <Container>
        <Row className={''}>
          <Col
            lg={{ span: 6 }}
            md={{ span: 12 }}
            span={24}
            className={'md:px-[1.2rem] lg:px-0'}
          >
            <div>
              <div
                className={
                  'md:mt-[-4rem] lg:block w-[14.4rem] h-[6.8rem] md:w-[34.4rem] md:h-[9.8rem]'
                }
              >
                <Image
                  src={ImageLogo}
                  alt={'Logo King study footer'}
                  width={167}
                  height={104}
                  className={'max-w-full lg:h-auto'}
                  priority
                />
              </div>
            </div>
            <p className="text-body-14 text-white font-[400] mt-[0.8rem] mb-[5.6rem] leading-[140%] lg:max-w-[30.6rem] lg:mt-[1.3rem] lg:mb-[0.21rem] lg:text-body-16">
              Hơn 10 năm đồng hành cùng học sinh Việt Nam, KingStudy cam kết
              mang đến các giải pháp du học toàn diện, miễn phí hỗ trợ hồ sơ,
              đảm bảo quy trình nhanh chóng và hiệu quả.
            </p>
            <div className="hidden lg:flex lg:gap-x-[1.6rem] lg:mt-[2.2rem]">
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Facebook} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Twitter} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Instagram} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Likedine} />
              </div>
            </div>
          </Col>
          <Col
            lg={{ span: 6 }}
            md={{ span: 12 }}
            span={12}
            className={'md:px-[1.2rem] lg:px-0'}
          >
            <div className={'lg:ml-[13rem] mb-[4rem]'}>
              <h6 className="text-body-18 font-[600] leading-[140%] text-white">
                Dịch vụ hỗ trợ
              </h6>
              <ul className="pl-0 mt-[2.4rem]">
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Tư vấn du học
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Hướng dẫn viết luận
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Luyện phỏng vấn
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Visa
                  </Link>
                </li>
              </ul>
            </div>
          </Col>
          <Col
            lg={{ span: 6 }}
            md={{ span: 12 }}
            span={12}
            className={'md:px-[1.2rem] lg:px-0'}
          >
            <div className={'lg:ml-[12rem] mb-[4rem]'}>
              <h6 className="text-body-18 font-[600] leading-[140%] text-white">
                Dịch vụ khác
              </h6>
              <ul className="pl-0 mt-[2.4rem]">
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Tự nộp hồ sơ
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Chuyển tiền quốc tế
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Vé máy bay
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Bảo hiểm
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Định cư
                  </Link>
                </li>
              </ul>
            </div>
          </Col>
          <Col
            lg={{ span: 6 }}
            md={{ span: 12 }}
            span={12}
            className={'md:px-[1.2rem] lg:px-0'}
          >
            <div className={'lg:ml-[11rem] mb-[4rem]'}>
              <h6 className="text-body-18 font-[600] leading-[140%] text-white">
                Về chúng tôi
              </h6>
              <ul className="pl-0 mt-[2.4rem]">
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Giới thiệu
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Liên Hệ
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Facebook
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Youtube
                  </Link>
                </li>
                <li className="mb-[1.6rem]">
                  <Link
                    className="text-body-16 font-[400] text-style-24 leading-[140%]"
                    href="/"
                  >
                    Zalo
                  </Link>
                </li>
              </ul>
            </div>
          </Col>
          <Col
            lg={{ span: 6 }}
            md={{ span: 12 }}
            span={12}
            className={'md:px-[1.2rem] lg:px-0'}
          >
            <div className="flex lg:gap-x-[1.6rem] lg:hidden flex-wrap gap-x-[1rem] mb-2">
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Facebook} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Twitter} />
              </div>
            </div>
            <div className="flex lg:gap-x-[1.6rem] lg:hidden flex-wrap gap-x-[1rem]">
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Instagram} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Likedine} />
              </div>
            </div>
          </Col>
        </Row>
        <div className="hidden lg:flex lg:justify-between lg:items-center lg:bg-style-33 lg:px-[2.4rem] lg:py-[3rem] lg:rounded-[0.4rem] lg:mt-[6rem] max-w-[120rem]">
          <div className=" mt-[2.4rem] flex">
            <p className="text-body-14 max-w-[14.8rem]  text-white font-[400] leading-[140%] lg:text-body-16">
              © Copyrighted and Designed by Kingstudy
            </p>
            <div className="flex lg:gap-x-[1.6rem] lg:hidden">
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Facebook} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Twitter} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Instagram} />
              </div>
              <div className="rounded-[3rem] bg-style-33 py-[1.2rem] flex justify-center w-[4rem] h-[4rem]">
                <Icon name={EIconName.Likedine} />
              </div>
            </div>
          </div>
          <div className="flex gap-x-[1.2rem]">
            <div>
              <Icon name={EIconName.Music} color={EIconColor.WHITE} />
            </div>
            <div>
              <p className="text-body-14 text-style-26 font-[400] leading-[140%] mb-0">
                Gọi cho chúng tôi 24/7
              </p>
              <p className="text-body-16 text-style-5 font-[600] leading-[140%] mb-0 lg:text-body-18">
                056 999 9595
              </p>
            </div>
          </div>
          <Form className="mt-0 lg:w-[50rem]">
            <Form.Item name={'subribe'} className="mb-0">
              <Input
                placeholder={'Nhập Email'}
                suffix={
                  <ButtonComponent
                    title={'Subscribe'}
                    className={
                      'orange w-[16rem] px-[1.6rem] py-[0.9rem]  text-white font-[600] leading-[140%] lg:px-[0.8rem] lg:py-[1.2rem]'
                    }
                    secondIconName={EIconName.Subscribe}
                  />
                }
              />
            </Form.Item>
          </Form>
        </div>
        <div className="flex flex-wrap bg-style-33 px-[2.4rem] py-[3rem] rounded-[0.4rem] mt-[3.2rem] lg:hidden">
          <div className="flex gap-x-[1.8rem] md:justify-normal w-full justify-center">
            <div className="flex gap-x-[1.2rem]">
              <div>
                <Icon name={EIconName.Music} color={EIconColor.WHITE} />
              </div>
            </div>
            <div>
              <p className="text-body-14 text-style-26 font-[400] leading-[140%] mb-0">
                Gọi cho chúng tôi 24/7
              </p>
              <p className="text-body-16 text-style-5 font-[600] leading-[140%] mb-0 lg:text-body-18">
                (987) 547587587
              </p>
            </div>
          </div>
          <Form className="mt-[2.4rem] lg:w-[50rem]">
            <Form.Item name={'subribe'} className="mb-0">
              <Input
                placeholder={'Nhập Email'}
                suffix={
                  <ButtonComponent
                    title={'Subscribe'}
                    className={
                      'orange max-w-[12.5rem] px-[1.6rem] py-[0.9rem]  text-white font-[600] leading-[140%] lg:px-[0.8rem] lg:py-[1.2rem]'
                    }
                    secondIconName={EIconName.Subscribe}
                  />
                }
              />
            </Form.Item>
          </Form>
          <div>
            <div className=" mt-[2.4rem] flex">
              <p className="text-body-14 lg:max-w-[14.8rem]  text-white font-[400] leading-[140%]">
                © Copyrighted and Designed by Bdevs12321
              </p>
            </div>
          </div>
        </div>
      </Container>
    </footer>
  );
};
export default Footer;
