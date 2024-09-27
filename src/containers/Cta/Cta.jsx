import React, { useEffect, useState } from 'react';

import { Col, Flex, Row, Select } from 'antd';
import { Form } from 'antd';
import Image from 'next/image';
import { useRouter } from 'next/router';

import ImageCTA1 from '@/assets/images/image-cta-1.jpg';
import ImageCTA2 from '@/assets/images/image-cta-2.jpg';
import { ETypeNotification } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import Modal from '@/components/Modal';
import Container from '@/containers/Container';
import { useAPI } from '@/contexts/APIContext';
import { Paths } from '@/routers/constants';
import { getLevelCourse, sendContact } from '@/services/common';
import { showNotification, validationRules } from '@/utils/function';
import { useModalState } from '@/utils/hook';
import { changeArrayToOptions, rootUrl } from '@/utils/utils';

const englishSkills = [
  {
    label: 'IELTS',
    value: 'IELTS',
  },
  {
    label: 'Dưới 5.5',
    value: '5',
  },
  {
    label: '5.5 đến 7.0',
    value: '6',
  },
  {
    label: 'Trên 7.0',
    value: '7',
  },
];
const Cta = () => {
  const { countries } = useAPI();
  const [isModalVisible, handleOpen, handleClose] = useModalState();
  const { isLogin } = useAPI();
  const router = useRouter();
  const [country, setCountry] = useState('');
  const [levelCourse, setLevelCourse] = useState([]);
  const [loading, setLoading] = useState(false);
  const [form] = Form.useForm();
  const onSubmitProfile = () => {
    if (!isLogin)
      return showNotification(
        ETypeNotification.INFO,
        'Bạn cần phải đăng nhập để nộp hồ sơ !'
      );
    router.push(`${Paths.Profile.SubmitProfileStep}`);
  };
  const handleChangeCountry = (option) => {
    setCountry(option);
  };
  const getLevel = async () => {
    try {
      const response = await getLevelCourse();
      if (response?.code === 200) {
        const levelOption = changeArrayToOptions(response?.data?.level);
        setLevelCourse(levelOption);
      }
    } catch (e) {
      /* empty */
    }
  };

  useEffect(() => {
    getLevel().then();
  }, []);

  const onFinishSubmit = (values) => {
    const body = { ...values, country: country };
    onSaveContact(body).then();
  };

  const onSaveContact = async (body) => {
    try {
      setLoading(true);
      const response = await sendContact(body);
      if (response) {
        showNotification(
          ETypeNotification.SUCCESS,
          'Gửi thông tin liên hệ thành công !'
        );
      }
    } catch (e) {
      setLoading(false);
    } finally {
      setLoading(false);
      handleClose();
      form.resetFields();
    }
  };
  return (
    <section className={'lg:py-[7rem] py-[2rem]'}>
      {isModalVisible?.visible && (
        <Modal
          visible={isModalVisible?.visible}
          title={'Liên Hệ với chúng tôi'}
          onClose={handleClose}
          width={800}
        >
          <Form
            layout={'vertical'}
            className={'mt-[1.5rem]'}
            onFinish={onFinishSubmit}
            form={form}
          >
            <Row>
              <Col span={12}>
                <Form.Item
                  label={'Tên của bạn'}
                  className={'form-input-study-aboard'}
                  name={'name'}
                  required
                  rules={[validationRules.required('')]}
                >
                  <Input placeholder={'Tên của bạn ...'} />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  label={'Quốc gia du học'}
                  className={'form-input-study-aboard'}
                  name={'country'}
                >
                  <Select
                    allowClear
                    showSearch
                    placeholder="Nhập Quốc Gia..."
                    className={'w-full mb-5'}
                    onChange={(option) => handleChangeCountry(option)}
                    suffixIcon={
                      <Icon
                        name={EIconName.ArowDown}
                        color={EIconColor.STYLE_7}
                      />
                    }
                    filterOption={(input, option) =>
                      (option?.label.toLowerCase() ?? '').includes(
                        input.toLowerCase()
                      )
                    }
                  >
                    {countries &&
                      countries.map((item) => (
                        <Select.Option
                          key={item?.value}
                          value={item?.value}
                          label={item?.label}
                        >
                          <Flex align={'center'} gap={'small'}>
                            <Image
                              quality={100}
                              src={`${rootUrl}${item?.icon}`}
                              alt={''}
                              width={24}
                              height={24}
                            />
                            {item?.label}
                          </Flex>
                        </Select.Option>
                      ))}
                  </Select>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  label={'Số điên thoại'}
                  className={'form-input-study-aboard'}
                  name={'phone'}
                  required
                  rules={[validationRules.required('')]}
                >
                  <Input numberic placeholder={'Số điên thoại ...'} />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  label={'Bậc học'}
                  className={'form-input-study-aboard'}
                  name={'level_id'}
                >
                  <Select
                    options={levelCourse}
                    placeholder={'Bậc học'}
                    suffixIcon={
                      <Icon
                        name={EIconName.ArowDown}
                        color={EIconColor.STYLE_7}
                      />
                    }
                    allowClear
                    showSearch
                  />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  label={'Email'}
                  className={'form-input-study-aboard'}
                  name={'email'}
                >
                  <Input placeholder={'Email...'} />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item label={'Điểm IELTS'} name={'english_skill'}>
                  <Select
                    options={englishSkills}
                    placeholder={'Điểm IELTS'}
                    suffixIcon={
                      <Icon
                        name={EIconName.ArowDown}
                        color={EIconColor.STYLE_7}
                      />
                    }
                    allowClear
                    showSearch
                  />
                </Form.Item>
              </Col>
            </Row>
            <Flex gap={'small'} justify={'center'}>
              <ButtonComponent
                title={'Hủy'}
                className={'primary-outline w-[15rem]'}
                onClick={handleClose}
              />
              <ButtonComponent
                title={'Tiếp tục'}
                className={'primary w-[15rem]'}
                htmlType={'submit'}
                loading={loading}
              />
            </Flex>
          </Form>
        </Modal>
      )}
      <Container>
        <Row gutter={[24, 24]}>
          <Col span={24} md={{ span: 24 }} lg={{ span: 12 }}>
            <div className={'relative min-h-[27rem] p-[5rem_4rem] rounded-sm'}>
              <div className={'absolute w-full h-full top-0 left-0'}>
                <Image
                  quality={100}
                  src={ImageCTA2}
                  alt={''}
                  loading={'lazy'}
                  width={649}
                  height={273}
                  className={
                    'w-full h-full object-cover object-left lg:object-center rounded-sm'
                  }
                />
              </div>
              <div className={'relative max-w-[31rem]'}>
                <span
                  className={'lg:text-button-16 text-body-14 text-style-10'}
                >
                  Chẳng cần agent
                </span>
                <p
                  className={
                    'my-4 lg:text-title-24 text-button-16 text-style-7'
                  }
                >
                  Tự mình chinh phục ngôi trường bạn mơ ước bằng cách Tự nộp hồ
                  sơ
                </p>
                <ButtonComponent
                  title={'Tự nộp hồ sơ'}
                  className={'primary w-[14.8rem] mt-[3.2rem] lg:mt-0'}
                  loading={false}
                  onClick={onSubmitProfile}
                />
              </div>
            </div>
          </Col>
          <Col span={24} md={{ span: 24 }} lg={{ span: 12 }}>
            <div className={'relative min-h-[27rem] p-[5rem_4rem] rounded-sm'}>
              <div className={'absolute w-full h-full top-0 left-0'}>
                <Image
                  src={ImageCTA1}
                  alt={''}
                  quality={100}
                  loading={'lazy'}
                  width={649}
                  height={273}
                  className={
                    'w-full h-full object-cover object-left lg:object-center rounded-sm'
                  }
                />
              </div>
              <div className={'relative max-w-[31rem]'}>
                <span
                  className={'lg:text-button-16 text-body-14 text-style-10'}
                >
                  Đặt lịch ngay
                </span>
                <p
                  className={
                    'my-4 lg:text-title-24 text-button-16 text-style-7'
                  }
                >
                  Để được tư vấn và hỗ trợ chuẩn bị hồ sơ cùng các chuyên gia
                </p>
                <ButtonComponent
                  title={'Liên Hệ'}
                  className={'primary w-[14.8rem] mt-[3.2rem] lg:mt-0'}
                  loading={false}
                  onClick={handleOpen}
                />
              </div>
            </div>
          </Col>
        </Row>
      </Container>
    </section>
  );
};
export default Cta;
