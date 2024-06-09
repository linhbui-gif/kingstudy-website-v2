import { useEffect, useState } from 'react';

import { Col, Form, Radio, Row, Spin } from 'antd';
import Image from 'next/image';

import ImageAvatarDefault from '@/assets/images/image-avatar-default.png';
import ImageBannerProfile from '@/assets/images/image-profile-banner.jpg';
import {
  ETTypeGender,
  ETypeNotification,
  EUploadType,
  REGEX,
} from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconColor, EIconName } from '@/components/Icon/Icon.enum';
import Input from '@/components/Input';
import Upload from '@/components/Upload';
import { useAPI } from '@/contexts/APIContext';
import { updateProfile } from '@/services/profile';
import { uploadCommon } from '@/services/upload';
import { showNotification, validationRules } from '@/utils/function';

const ChangeProfileInformation = ({ avatarStateUrl = '' }) => {
  const [value, setValue] = useState(ETTypeGender.MALE);
  const [previewImage, setPreviewImage] = useState(null);
  const [isChanged, setIsChanged] = useState(false);
  const [fileNameAvatar, setFileNameAvatar] = useState('');
  const [loadingUpdate, setLoadingUpdate] = useState(false);
  const { profileState, getProfileInfor, loadingGetProfileState } = useAPI();
  const [form] = Form.useForm();
  const handleUploadChange = (files) => {
    if (files) {
      const file = Array.from(files)?.[0];
      const formData = new FormData();
      formData.append('files[]', file);
      onUploadImageTmp(formData).then();
      setPreviewImage({
        ...previewImage,
        avatar: URL.createObjectURL(file),
      });
      setIsChanged(true);
    }
  };
  const onUploadImageTmp = async (body) => {
    try {
      const response = await uploadCommon(EUploadType.USER, body);
      if (response?.files) {
        setFileNameAvatar(response?.files?.[0]?.name);
      }
    } catch (e) {
      /* empty */
    }
  };
  useEffect(() => {
    if (!isChanged) {
      if (REGEX.url.test(avatarStateUrl || '')) {
        setPreviewImage({
          ...previewImage,
          avatar: avatarStateUrl,
        });
      } else if (avatarStateUrl?.lastModified) {
        setPreviewImage({
          ...previewImage,
          avatar: URL.createObjectURL(avatarStateUrl),
        });
      } else {
        setIsChanged(false);
        setPreviewImage(null);
      }
    }
  }, [avatarStateUrl]);
  const onFinishSubmit = (values) => {
    const body = { ...values, image: fileNameAvatar };
    body['gender'] = value === 1 ? 'male' : 'female';
    updateProfileUser(body).then();
  };
  const updateProfileUser = async (body) => {
    try {
      setLoadingUpdate(true);
      const res = await updateProfile(body);
      if (res?.status === 200) {
        setLoadingUpdate(false);
        showNotification(
          ETypeNotification.SUCCESS,
          'Cập nhật thông tin cá nhân thành công !'
        );
        getProfileInfor().then();
      }
    } catch (e) {
      setLoadingUpdate(false);
    }
  };
  useEffect(() => {
    if (profileState) {
      form.setFieldsValue({
        full_name: profileState?.full_name,
        email: profileState?.email,
        phone: profileState?.phone,
        address: profileState?.address,
      });
      setValue(profileState?.gender === 'male' ? 1 : 2);
    }
  }, []);
  return (
    <div>
      <Spin spinning={loadingGetProfileState}>
        <div>
          <Image
            layout={'responsive'}
            loading={'lazy'}
            src={ImageBannerProfile}
            alt={''}
            className={'rounded-sm'}
          />
          <div className={'w-[26rem] translate-x-[3rem] -translate-y-1/4'}>
            <img
              width={260}
              height={260}
              loading={'lazy'}
              src={
                previewImage?.avatar ? previewImage?.avatar : ImageAvatarDefault
              }
              alt={''}
              className={'w-full object-cover rounded-full'}
            />
            <Upload
              accept=".jpg, .png, .jpeg"
              onChange={(data) => handleUploadChange(data)}
            >
              <span
                className={
                  'absolute bottom-0 right-0 translate-x-[20%] translate-y-[20%] flex items-center justify-center w-[40px] h-[40px] bg-main-color-2 rounded-full'
                }
              >
                <Icon name={EIconName.Camera} color={EIconColor.STYLE_10} />
              </span>
            </Upload>
          </div>
        </div>
        <div>
          <Form layout={'vertical'} form={form} onFinish={onFinishSubmit}>
            <Row>
              <Col span={12}>
                <Form.Item
                  label={'Tên của bạn'}
                  name={'full_name'}
                  required
                  rules={[validationRules.required('')]}
                >
                  <Input placeholder={'Nhập Họ & Tên...'} />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item
                  label={'Email'}
                  name={'email'}
                  required
                  rules={[validationRules.required('')]}
                >
                  <Input placeholder={'Email...'} />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item label={'Số điện thoại'} name={'phone'}>
                  <Input numberic placeholder={'Nhập số điện thoại...'} />
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item label={'Giới tính'}>
                  <Radio.Group
                    onChange={(e) => {
                      setValue(e.target.value);
                    }}
                    value={value}
                  >
                    <Radio value={ETTypeGender.MALE}>Nam</Radio>
                    <Radio value={ETTypeGender.FEMALE}>Nữ</Radio>
                  </Radio.Group>
                </Form.Item>
              </Col>
              <Col span={12}>
                <Form.Item label={'Địa chỉ'} name={'address'}>
                  <Input placeholder={'Nhập địa chỉ...'} />
                </Form.Item>
              </Col>
            </Row>
            <ButtonComponent
              title={'Cập nhật'}
              className={'primary min-w-[15rem]'}
              htmlType={'submit'}
              loading={loadingUpdate}
            />
          </Form>
        </div>
      </Spin>
    </div>
  );
};
export default ChangeProfileInformation;
