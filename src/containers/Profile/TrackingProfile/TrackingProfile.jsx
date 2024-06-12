import { useEffect, useState } from 'react';

import { Skeleton, Table } from 'antd';
import moment from 'moment';
import Image from 'next/image';

import { EFormat } from '@/common/enums';
import { followProfileUser } from '@/services/profile';
import { renderStatusCourse } from '@/utils/function';
import { rootUrl, statusSchool } from '@/utils/utils';

const TrackingProfile = () => {
  const [dataProfileTrack, setDataProfileTrack] = useState([]);
  const [loading, setLoading] = useState(false);
  const expandedRowRender = (record) => {
    const rowData = record?.details;
    const columns = [
      {
        title: 'Tên của bạn',
        dataIndex: 'name',
        key: 'name',
      },
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
        render: () => {
          return (
            <span className={'cursor-pointer text-orange'}>Xem chi tiết</span>
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
            <Image
              src={`${rootUrl}${logo}`}
              alt={''}
              width={100}
              height={100}
              layout={'fixed'}
              loading={'lazy'}
              className={'max-w-full h-full object-contain'}
            />
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
          />
        )}
      </div>
    </div>
  );
};
export default TrackingProfile;
