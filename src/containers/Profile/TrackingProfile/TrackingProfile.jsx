import { useEffect, useState } from 'react';

import { Col, Row } from 'antd';
import { Skeleton, Table } from 'antd';
import moment from 'moment';
import Image from 'next/image';

import { EFormat } from '@/common/enums';
import Icon from '@/components/Icon';
import { EIconName } from '@/components/Icon/Icon.enum';
import Modal from '@/components/Modal';
import { useAPI } from '@/contexts/APIContext';
import { followProfileUser } from '@/services/profile';
import { renderStatusCourse } from '@/utils/function';
import { getFileExtension } from '@/utils/function';
import { useModalState } from '@/utils/hook';
import { rootUrl, statusSchool } from '@/utils/utils';
const TrackingProfile = () => {
  const [dataProfileTrack, setDataProfileTrack] = useState([]);
  const [loading, setLoading] = useState(false);
  const [isModalVisible, handleOpen, handleClose] = useModalState();
  const { profileState } = useAPI();
  const [detailCourse, setDetailCourse] = useState(null);
  const attachMentAcademic = detailCourse?.attachment_1;
  const attachMentProfile = detailCourse?.attachment_2;
  const attachMentFinacial = detailCourse?.attachment_3;

  const handleOpenModal = (data) => {
    setDetailCourse(data);
    handleOpen();
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
                    <div className={'shadow-md rounded-sm w-[20rem]'}>
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
  const expandedRowRender = (record) => {
    const rowData = record?.details;
    const columns = [
      {
        title: 'Khóa học',
        dataIndex: 'course',
        key: 'course',
        render: (course) => {
          return <span>{course?.name}</span>;
        },
      },
      {
        title: 'Quốc gia du học',
        key: 'country',
        dataIndex: 'country',
        render: (country) => {
          return <span>{country?.name}</span>;
        },
      },
      {
        title: 'Thời gian gửi',
        dataIndex: 'created_at',
        key: 'created_at',
        render: (created_at) => {
          return (
            <span>
              {moment(created_at).format(EFormat['DD/MM/YYYY - HH:mm'])}
            </span>
          );
        },
      },
      {
        title: 'Trạng thái',
        dataIndex: 'status',
        key: 'status',
        render: (status) => {
          return <span>{renderStatusCourse(status)}</span>;
        },
      },
      {
        title: 'Hành động',
        dataIndex: 'tool',
        key: 'tool',
        render: (index, row) => {
          return (
            <span
              className={'cursor-pointer text-orange'}
              onClick={() => handleOpenModal(row)}
            >
              Xem chi tiết
            </span>
          );
        },
      },
    ];
    return (
      <Table
        rowKey={(record, index) => `${record.id}-${index}`}
        columns={columns}
        dataSource={rowData}
        pagination={false}
      />
    );
  };
  const columns = [
    {
      title: 'Logo',
      dataIndex: 'logo',
      key: 'logo',
      render: (logo) => {
        return (
          <div className={'w-[10rem] h-[10rem]'}>
            {logo && (
              <Image
                src={`${rootUrl}${logo}`}
                alt={''}
                width={100}
                height={100}
                layout={'fixed'}
                loading={'lazy'}
                className={'max-w-full h-full object-contain'}
              />
            )}
          </div>
        );
      },
    },
    {
      title: 'Tên trường',
      dataIndex: 'school_name',
      key: 'school_name',
    },
    {
      title: 'Type',
      dataIndex: 'type_school',
      key: 'type_school',
      render: (type_school) => {
        return statusSchool(type_school);
      },
    },
  ];
  const onTrackingProfile = async () => {
    try {
      setLoading(true);
      const response = await followProfileUser();
      if (response?.status === 200) {
        setLoading(false);
        const data = response?.data;
        const normalizedData = Object.entries(data).map(([key, value]) => {
          return {
            id: key,
            school_name: value[0]?.school?.name,
            logo: value[0]?.school?.logo,
            type_school: value[0]?.school?.type_school,
            details: value,
          };
        });
        setDataProfileTrack(normalizedData);
      }
    } catch (e) {
      setLoading(false);
    }
  };

  useEffect(() => {
    onTrackingProfile().then();
  }, []);
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>Theo dõi hồ sơ</h4>
      <div>
        {loading && <Skeleton />}
        {!loading && (
          <Table
            pagination={false}
            columns={columns}
            expandable={{
              expandedRowRender,
              rowExpandable: (record) => record.details.length > 0,
            }}
            dataSource={dataProfileTrack}
            rowKey={'id'}
            scroll={{ x: 1920 }}
          />
        )}
        {isModalVisible?.visible && (
          <Modal
            className="profile"
            visible={isModalVisible?.visible}
            title="Thông Tin hồ sơ"
            onClose={handleClose}
            width={1000}
            centered={false}
          >
            <Row gutter={[20, 20]} className={'p-[2rem]'}>
              <Col span={12}>
                <span>Họ và Tên: </span>
                <strong>{detailCourse?.name}</strong>
              </Col>
              <Col span={12}>
                <span>Số điện thoại: </span>
                <strong>{detailCourse?.phone}</strong>
              </Col>
              <Col span={12}>
                <span>Email: </span>
                <strong>{detailCourse?.email}</strong>
              </Col>
              <Col span={12}>
                <span>Giới tính: </span>
                <strong>{profileState?.profile?.user?.gender}</strong>
              </Col>
              <Col span={12}>
                <span>Quốc gia du học: </span>
                <strong>{detailCourse?.country?.name}</strong>
              </Col>
              <Col span={12}>
                <span>Bậc học: </span>
                <strong>{profileState?.profile?.level?.name}</strong>
              </Col>
              <Col span={12}>
                <span>Thời gian gửi: </span>
                <strong>
                  {moment(detailCourse?.created_at)?.format(
                    EFormat['DD/MM/YYYY - HH:mm']
                  )}
                </strong>
              </Col>
              <Col span={12}>
                <span>IELTS: </span>
                <strong>
                  {renderEnglishSkill(detailCourse?.english_skill)}
                </strong>
              </Col>
              <Col span={12}>
                <span>Trạng thái: </span>
                <strong>{renderStatusCourse(detailCourse?.status)}</strong>
              </Col>
            </Row>
            <div>
              {renderProfile(
                attachMentAcademic,
                attachMentProfile,
                attachMentFinacial
              )}
            </div>
          </Modal>
        )}
      </div>
    </div>
  );
};
export default TrackingProfile;
