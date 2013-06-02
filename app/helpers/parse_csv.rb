require 'csv'

def parseCSV(file,date,lat,long,type)
    @parsed_file = CSV::Reader.parse(File.open(file))
    csv_out = CSV::Writer.generate(File.open('parsed'+file,'wb'))
    csv_out << ["time_created","latitude","longitude","severity"] 
    @parsed_file.each_with_index do |row,x|
        severity = -> lambda {type_id.index.include? row[type]}
        severe = nil
        case typeCol
        when severity.call('rob')
            severe = 5
        when severity.call('murder')
            severe = 4
        else
            severe = 3
        end
        csv_out << [row[date],row[lat],row[long],severe]

    end
    csv_out.close


