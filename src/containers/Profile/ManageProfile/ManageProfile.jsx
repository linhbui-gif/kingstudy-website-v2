import React from 'react';

import { Col, Row, Spin } from 'antd';
import moment from 'moment';
import { useRouter } from 'next/router';

import { EFormat } from '@/common/enums';
import ButtonComponent from '@/components/Button';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Tabs from '@/components/Tabs';
import { Paths } from '@/routers/constants';
import { getFileExtension } from '@/utils/function';

const ManageProfile = ({ profileState, loading }) => {
  const userInformation = profileState?.profile?.user;
  const userProfileSubmit = profileState?.profile;
  const attachMentAcademic = userProfileSubmit?.attachment_1;
  const attachMentProfile = userProfileSubmit?.attachment_2;
  const attachMentFinacial = userProfileSubmit?.attachment_3;
  const router = useRouter();
  const renderEnglishSkill = (eng_skill) => {
    switch (eng_skill) {
      case '5':
        return <span>Dưới 5.5</span>;
      case '6':
        return <span>5.5 đến 7.0</span>;
      default:
        return <span>Trên 7.0</span>;
    }
  };

  const renderNameProfile = (name) => {
    switch (name) {
      case 'academic':
        return <span>HỒ SƠ HỌC THUẬT</span>;
      case 'profile':
        return <span>HỒ SƠ CÁ NHÂN</span>;
      case 'finacial':
        return <span>HỒ SƠ TÀI CHÍNH</span>;
      default:
        return <></>;
    }
  };
  const renderProfile = (arrAcademic, arrProfile, arrFinacial) => {
    const arr = [];
    const arrCombine = [...arr, arrAcademic, arrProfile, arrFinacial];
    const arrKey = ['academic', 'profile', 'finacial'];
    const arrCombineGroupKey =
      arrKey &&
      arrKey.map((key, index) => {
        let obj = {};
        obj[key] = arrCombine[index];
        return obj;
      });
    return (
      arrCombineGroupKey &&
      arrCombineGroupKey.map((combineKey, index) => {
        const arrFinal = Object.values(combineKey)?.[0];
        return (
          <Row gutter={[20, 20]} className={'p-[2rem]'} key={index}>
            <Col span={24} className={'text-title-20'}>
              {renderNameProfile(Object.keys(combineKey)[0])}
            </Col>
            {arrFinal?.length > 0 ? (
              arrFinal.map((element) => {
                const ext = element?.url ? getFileExtension(element?.url) : '';
                const icon = (
                  <Icon
                    className={'m'}
                    name={ext === 'docx' ? EIconName.Words : EIconName.Pdf}
                  />
                );
                return (
                  <Col span={6} key={element?.url}>
                    <div className={'shadow-md rounded-sm'}>
                      <div
                        className={
                          'flex items-center justify-center bg-style-10 rounded-sm min-h-[10rem]'
                        }
                      >
                        {icon}
                      </div>
                      <div className={'p-[2rem_1rem]'}>
                        <h5 className={'text-body-14 font-[500]'}>
                          {element?.name}
                        </h5>
                      </div>
                    </div>
                  </Col>
                );
              })
            ) : (
              <>
                <p className={'px-[1.2rem]'}>Chưa có thông tin </p>
              </>
            )}
          </Row>
        );
      })
    );
  };
  const manageProfileOptions = [
    {
      key: 'information',
      title: 'Thông tin cá nhân',
      children: (
        <div>
          <Spin spinning={loading}>
            <Row gutter={[20, 20]} className={'p-[2rem]'}>
              <Col span={12}>
                <span>Họ và Tên: </span>
                <strong>{userProfileSubmit?.name}</strong>
              </Col>
              <Col span={12}>
                <span>Số điện thoại: </span>
                <strong>{userInformation?.phone}</strong>
              </Col>
              <Col span={12}>
                <span>Giới tính: </span>
                <strong>{userInformation?.gender}</strong>
              </Col>
              <Col span={12}>
                <span>Quốc gia du học: </span>
                <strong>{userProfileSubmit?.country?.name}</strong>
              </Col>
              <Col span={12}>
                <span>Bậc học: </span>
                <strong>{userProfileSubmit?.level?.name}</strong>
              </Col>
              <Col span={12}>
                <span>Thời gian gửi: </span>
                <strong>
                  {moment(userProfileSubmit?.created_at)?.format(
                    EFormat['DD/MM/YYYY - HH:mm']
                  )}
                </strong>
              </Col>
              <Col span={12}>
                <span>IELTS: </span>
                <strong>
                  {renderEnglishSkill(userProfileSubmit?.english_skill)}
                </strong>
              </Col>
              <Col span={24}>
                <ButtonComponent
                  className={'primary w-[15rem]'}
                  title={'Chỉnh sửa'}
                  onClick={() => {
                    router.push(`${Paths.Profile.SubmitProfileStep}`);
                  }}
                />
              </Col>
            </Row>
          </Spin>
        </div>
      ),
    },
    {
      key: 'profile',
      title: 'Thông tin hồ sơ',
      children: (
        <div>
          {renderProfile(
            attachMentAcademic,
            attachMentProfile,
            attachMentFinacial
          )}
        </div>
      ),
    },
  ];
  return (
    <div className={'px-[2rem]'}>
      <Tabs options={manageProfileOptions} defaultKey="information" />
    </div>
  );
};
export default ManageProfile;
