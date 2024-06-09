import { Table } from 'antd';

const TrackingProfile = () => {
  const expandedRowRender = () => {
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
      },
      {
        title: 'Quốc gia du học',
        key: 'country',
      },
      {
        title: 'Thời gian gửi',
        dataIndex: 'time_send',
        key: 'time_send',
      },
      {
        title: 'Trạng thái',
        dataIndex: 'status',
        key: 'status',
      },
    ];
    const data = [];
    for (let i = 0; i < 3; ++i) {
      data.push({
        key: i.toString(),
        course: '2014-12-24 23:12:00',
        name: 'This is production name',
        time_send: 'Upgraded: 56',
        status: 'Upgraded: 56',
      });
    }
    return <Table columns={columns} dataSource={data} pagination={false} />;
  };
  const columns = [
    {
      title: 'Logo',
      dataIndex: 'logo',
      key: 'logo',
    },
    {
      title: 'Name',
      dataIndex: 'name',
      key: 'name',
    },
    {
      title: 'Description',
      dataIndex: 'description',
      key: 'description',
    },
    {
      title: 'Type',
      dataIndex: 'type',
      key: 'type',
    },
  ];
  const data = [];
  for (let i = 0; i < 3; ++i) {
    data.push({
      key: i.toString(),
      name: 'Screen',
      logo: 'iOS',
      description: '10.3.4.5654',
      type: 500,
    });
  }
  return (
    <div className={'p-[2rem]'}>
      <h4 className={'text-title-24 text-style-7'}>Theo dõi hồ sơ</h4>
      <div>
        <Table
          pagination={false}
          columns={columns}
          expandable={{
            expandedRowRender,
            defaultExpandedRowKeys: ['0'],
          }}
          dataSource={data}
        />
      </div>
    </div>
  );
};
export default TrackingProfile;
